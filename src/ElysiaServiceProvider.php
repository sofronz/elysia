<?php

namespace Sofronz\Elysia;

use Sofronz\Elysia\Filters\Filter;
use Illuminate\Support\ServiceProvider;

/**
 * Class ElysiaServiceProvider
 *
 * Service provider for registering and binding filters to the Laravel container.
 * This provider registers filters based on the models defined in the 'elysia.php' configuration file,
 * allowing the use of filters specific to the registered models.
 *
 * @package Sofronz\Elysia
 *
 * Author: Sofronius Ruddy (GitHub: @sofronz)
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
class ElysiaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider within the application container.
     *
     * During this phase, the list of models defined in the configuration file will be read,
     * and for each model, a singleton binding for the corresponding filter will be registered
     * in the Laravel container.
     */
    public function register()
    {
        // Retrieve the list of models from the 'elysia.php' configuration file
        $models = config('elysia.models');
        
        // Loop through each registered model and bind the corresponding filter
        foreach ($models as $key => $model) {
            $this->app->singleton("elysia.$key", function ($app) use ($model) {
                // Create an instance of Filter for the corresponding model
                return new Filter($app['request'], $model, $model);
            });
        }
    }

    /**
     * Booting phase for the service provider.
     *
     * During this phase, the configuration file can be published to the application's config directory
     * if needed. This is typically used for configuring and setting up services related to this provider.
     */
    public function boot()
    {
        // Publish the 'elysia.php' configuration file to the application's config directory
        $this->publishes([
            __DIR__.'/../config/elysia.php' => config_path('elysia.php'),
        ], 'config');
    }
}
