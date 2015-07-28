<?php

return [

    'default_bouncer' => Optimus\Castle\Bouncer\NotFoundBouncer::class,

    'default_guard' => Optimus\Castle\Guard\EqualGuard::class,

    'bouncers' => [
        '403' => Optimus\Castle\Bouncer\ForbiddenBouncer::class,
        '404' => Optimus\Castle\Bouncer\NotFoundBouncer::class,
        'boolean' => Optimus\Castle\Bouncer\BooleanBouncer::class
    ],

    'guards' => [

    ],

    'delimiter' => '-'

];
