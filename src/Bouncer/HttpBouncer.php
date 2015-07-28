<?php

namespace Optimus\Castle\Bouncer;

use Optimus\Castle\Bouncer\BouncerInterface;

abstract class HttpBouncer implements BouncerInterface {

    protected $text;

    public function __construct($text = null)
    {
        $this->text = $text;
    }

    protected function abort($code)
    {
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        $header = $protocol . ' ' . $code;
        if (!is_null($this->text)) {
            $header .= " $this->text";
        }

        header($header);
        exit;
    }

}
