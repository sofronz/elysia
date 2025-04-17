<?php

namespace Sofronz\Elysia;

use Sofronz\Elysia\Filters\Filter;
use Illuminate\Support\ServiceProvider;

/**
 * Class ElysiaServiceProvider
 *
 * Registers and binds filters to the Laravel container based on the models
 * defined in the elysia.php config file.
 *
 * Author: Sofronius Ruddy (GitHub: @sofronz)
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
class ElysiaServiceProvider extends ServiceProvider
{
    /**
     * Register services in the container.
     */
    public function register()
    {
        $models = config('elysia.models', []);

        foreach ($models as $key => $model) {
            $this->app->singleton("elysia.$key", function ($app) use ($model) {
                return new Filter($app['request'], $model);
            });
        }
    }

    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/elysia.php' => config_path('elysia.php'),
        ], 'config');
    }
}
