<?php

namespace Aristech\NimbaSms\Providers;

use Illuminate\Support\ServiceProvider;
use Aristech\NimbaSms\NimbaSmsClient;
use Aristech\NimbaSms\Config\NimbaSmsConfig;
use Aristech\NimbaSms\Contracts\SmsClientInterface;

class NimbaSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Fusionner la configuration par défaut
        $this->mergeConfigFrom(__DIR__ . '/../../config/nimbasms.php', 'nimbasms');

        $this->app->singleton(NimbaSmsConfig::class, function ($app) {
            $config = $app['config']['nimbasms'];
            return new NimbaSmsConfig(
                $config['serviceId'],
                $config['secret'],
                $config['baseUrl'] ?? 'https://api.nimbasms.com/'
            );
        });

        $this->app->singleton(SmsClientInterface::class, function ($app) {
            return new NimbaSmsClient($app->make(NimbaSmsConfig::class));
        });
    }

    public function boot(): void
    {
        // Publier le fichier de configuration dans config/
        $this->publishes([
            __DIR__ . '/../../config/nimbasms.php' => config_path('nimbasms.php'),
        ], 'config');
    }
}
