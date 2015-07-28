<?php

return [

    'default_bouncer' => Optimus\Castle\Bouncer\NotFoundBouncer::class,

    'default_guard' => Optimus\Castle\Integration\Laravel\EloquentGuard::class,

    'bouncers' => [
        '403' => Optimus\Castle\Bouncer\ForbiddenBouncer::class,
        '404' => Optimus\Castle\Bouncer\NotFoundBouncer::class,
        'boolean' => Optimus\Castle\Bouncer\BooleanBouncer::class
    ],

    'guards' => [
        'variant-stock' => 'product_variant_id',
        'entity-entity' => [
            'class' => App\Guards\EntityEntity::class
        ]
    ],

    'delimiter' => '-'

];
