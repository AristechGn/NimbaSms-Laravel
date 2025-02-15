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

    /**
     * Utilisez defineEnvironment() au lieu de getEnvironmentSetUp() 
     * pour éviter les avertissements de dépréciation d'Orchestra Testbench.
     */
    protected function defineEnvironment($app)
    {
        // Configuration de test
        $app['config']->set('nimbasms.serviceId', 'test_service_id');
        $app['config']->set('nimbasms.secret', 'test_secret');
        $app['config']->set('nimbasms.baseUrl', 'https://api.nimbasms.com/');
        $app['config']->set('nimbasms.ssl_verify', false);
    }
} 