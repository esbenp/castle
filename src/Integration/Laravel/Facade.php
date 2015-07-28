<?php

namespace Optimus\Castle\Integration\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Optimus\Castle\Castle
 */
class Castle extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'castle';
    }
}
