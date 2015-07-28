<?php

namespace Optimus\Castle;

use InvalidArgumentException;
use Optimus\Castle\Bouncer\BouncerInterface;
use Optimus\Castle\Guard\GuardInterface;

class Gate {

    private $config;

    private $guard;

    private $bouncer;

    private $bouncerData = [];

    public function __construct(array $config, $guard, $bouncer = null, $bouncerData = null)
    {
        $this->config = $config;
        $this->guard = $this->resolveGuardInput($guard);

        // Bouncer data is injected into the bouncer constructor, so
        // we resolve that first.
        $this->bouncerData = $this->resolveBouncerDataInput($bouncerData);
        $this->bouncer = $this->resolveBouncerInput($bouncer);
    }

    public function bounce()
    {
        return $this->bouncer->bounce();
    }

    public function run($data)
    {
        if (!is_array($data)) {
            $data = [$data];
        }

        return call_user_func_array([$this->guard, 'run'], $data);
    }

    private function resolveGuardInput($guard)
    {
        if ($guard instanceof GuardInterface) {
            return $guard;
        } elseif (is_string($guard)) {
            if (!array_key_exists($guard, $this->config['guards'])) {
                throw new InvalidArgumentException($guard . ' has no guard definition.');
            }

            $config = $this->config['guards'][$guard];

            // Config are delimitered identifiers and should be
            // resolved using default guard
            if (is_string($config)) {
                $class = $this->config['default_guard'];
                $args = $this->resolveIdentifiers($config);
            } else if(is_array($config)) {
                $class = $config['class'];
                $args = array_key_exists('args', $config) ? $config['args'] : [];
            }

            $reflectionClass = new \ReflectionClass($class);
            $instance = $reflectionClass->newInstanceArgs($args);

            if (!($instance instanceof GuardInterface)) {
                throw new InvalidArgumentException(get_class($instance) .
                ' should implement Optimus\Castle\Guard\GuardInterface');
            }

            return $instance;
        }
    }

    private function resolveIdentifiers($identifiers)
    {
        return explode($this->config['delimiter'], $identifiers);
    }

    private function resolveBouncerDataInput($bouncerData)
    {
        if (is_null($bouncerData)) {
            return [];
        } elseif (is_array($bouncerData)) {
            return $bouncerData;
        } else {
            return [$bouncerData];
        }
    }

    private function resolveBouncerInput($bouncer)
    {
        // If an actual instance was given, simply use it
        if ($bouncer instanceof BouncerInterface){
            return $bouncer;
        // If a string was passed, we look for a definition in the
        // config
        } elseif(is_string($bouncer) && array_key_exists($bouncer, $this->config['bouncers'])) {
            $class = $this->config['bouncers'][$bouncer];
        // If null we fallback to the default bouncer
        } elseif(is_null($bouncer)) {
            $class = $this->config['default_bouncer'];
        } else {
            throw new \RuntimeException("$bouncer is not a valid bouncer.");
        }

        $reflectionClass = new \ReflectionClass($class);
        $instance = $reflectionClass->newInstanceArgs($this->bouncerData);

        if (!($instance instanceof BouncerInterface)) {
            throw InvalidArgumentException(get_class($instance) . ' should implement Optimus\Castle\Bouncer\BouncerInterface');
        }

        return $instance;
    }

}
