<?php

namespace Optimus\Castle\Integration\Symfony\Bouncer;

use Optimus\Castle\Bouncer\BouncerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class HttpBouncer implements BouncerInterface {

    protected $text;

    public function __construct($text = null)
    {
        $this->text = $text;
    }

    protected function abort($code)
    {

        if ($code == 404) {
            throw new NotFoundHttpException($this->text);
        }

        throw new HttpException($code, $this->text);
    }

}
