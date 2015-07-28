<?php

namespace Optimus\Castle\Bouncer;

use Optimus\Castle\Bouncer\BouncerInterface;

class BooleanBouncer implements BouncerInterface {

    public function bounce()
    {
        return false;
    }

}
