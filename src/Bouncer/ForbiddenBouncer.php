<?php

namespace Optimus\Castle\Bouncer;

use Optimus\Castle\Bouncer\HttpBouncer;

class ForbiddenBouncer extends HttpBouncer {

    public function bounce()
    {
        $this->abort(403);
    }

}
