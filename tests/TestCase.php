<?php

namespace Aristech\NimbaSms\Tests;

use Aristech\NimbaSms\Providers\NimbaSmsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            NimbaSmsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        // Configuration de test
        $app['config']->set('nimbasms.serviceId', 'test_service_id');
        $app['config']->set('nimbasms.secret', 'test_secret');
        $app['config']->set('nimbasms.baseUrl', 'https://api.nimbasms.com/');
    }
} 