<?php

namespace Fluxtor\Cli;

use Fluxtor\Cli\Commands\AddComponentCommand;
use Fluxtor\Cli\Commands\ListCommand;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([ListCommand::class]);
            $this->commands([AddComponentCommand::class]);
        }

        $this->publishes(
            [
                __DIR__ . '/../config/fluxtor.php' => config_path('fluxtor.php'),
            ],
            'fluxtor-config',
        );
    }

    public function register()
    {
        // bind services if needed

        $this->mergeConfigFrom(__DIR__ . '/../config/fluxtor.php', 'fluxtor');
    }
}
