<?php

namespace Optimus\Castle\Bouncer;

use Optimus\Castle\Bouncer\HttpBouncer;

class NotFoundBouncer extends HttpBouncer {

    public function bounce()
    {
        $this->abort(404);
    }

}
