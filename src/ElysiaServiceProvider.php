<?php

namespace Sofronz\Elysia;

use Illuminate\Support\ServiceProvider;

class ElysiaServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/elysia.php' => config_path('elysia.php'),
        ], 'config');
    }
}