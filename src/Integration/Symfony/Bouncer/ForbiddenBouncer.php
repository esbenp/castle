<?php

namespace Optimus\Castle\Integration\Symfony\Bouncer;

use Optimus\Castle\Integration\Symfony\Bouncer\HttpBouncer;

class ForbiddenBouncer extends HttpBouncer {

    public function bounce()
    {
        $this->abort(403);
    }

}
