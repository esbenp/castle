<?php

namespace Optimus\Castle;

use Optimus\Castle\Gate;

class Castle {

    private $gates;

    private $config;

    public function __construct(array $config, array $gates = [])
    {
        $this->config = $config;
        $this->gates = $this->resolveGates($gates);
    }

    public function make(array $gates = [])
    {
        return new static($this->config, $gates);
    }

    public function createGate($guard, $bouncer = null, $bouncerData = null)
    {
        return new Gate($this->config, $guard, $bouncer, $bouncerData);
    }

    public function run($data)
    {
        foreach($this->gates as $i => $gate) {
            if ($gate->run($data[$i]) === false) {
                return $gate->bounce();
            }
        }

        return true;
    }

    private function resolveGates(array $gates)
    {
        return array_map(function($gate){
            if ($gate instanceof Gate) {
                return $gate;
            } elseif(is_array($gate)) {
                return call_user_func_array([$this, 'createGate'], $gate);
            } else {
                return call_user_func([$this, 'createGate'], $gate);
            }
        }, $gates);
    }

}
