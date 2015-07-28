<?php

namespace Optimus\Castle\Integration\Symfony\Bouncer;

use Optimus\Castle\Integration\Symfony\Bouncer\HttpBouncer;

class NotFoundBouncer extends HttpBouncer {

    public function bounce()
    {
        $this->abort(404);
    }

}
