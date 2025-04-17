<?php

namespace Sofronz\Elysia\Facades;

use Illuminate\Support\Facades\Facade;
use Sofronz\Elysia\Filters\Filter as ServiceFilter;

/**
 * Class Filter
 *
 * Facade for accessing model-based filters registered in the Laravel container.
 * Allows calling Filter::model('user') to resolve the filter instance bound to 'user' model.
 *
 * @method static Filter model(string $key)
 *
 * @package Sofronz\Elysia\Facades
 *
 * Author: Sofronius Ruddy (GitHub: @sofronz)
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
class Filter extends Facade
{
    /**
     * Get the registered name of the base component.
     *
     * This won't be used because we're overriding `model()` manually.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'elysia.filter';
    }

    /**
     * Retrieve a filter instance for a specific model key.
     *
     * @param string $key The key defined in config/elysia.php
     * @return ServiceFilter
     */
    public static function model(string $key): ServiceFilter
    {
        if (!app()->bound("elysia.$key")) {
            throw new \InvalidArgumentException("Filter for model key [$key] is not registered.");
        }
        
        return app("elysia.$key");
    }
}
