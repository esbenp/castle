<?php

namespace Optimus\Castle\Integration\Laravel;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Optimus\Castle\Castle;

class ServiceProvider extends BaseProvider {

    const packageKey = 'castle';

    public function register()
    {
        $this->loadConfig();
        $this->bindInstance();
    }

    private function bindInstance()
    {
        $this->app->bindShared('castle', function(){
            $config = $this->app['config']->get(self::packageKey);

            return new Castle($config);
        });
    }

    private function loadConfig()
    {
        if ($this->app['config']->get(self::packageKey) === null) {
            $this->app['config']->set(self::packageKey, require __DIR__.'/../../config/' . self::packageKey . '.php');
        }
    }

}
