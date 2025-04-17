<?php

namespace Sofronz\Elysia\Traits;

/**
 * Trait FilterCheckerTrait
 *
 * Provides helper methods to identify filter types based on query parameter suffixes.
 *
 * Author: Sofronius Ruddy (GitHub: @sofronz)
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
trait FilterCheckerTrait
{
    /**
     * Determine if the filter key is a sort filter.
     *
     * @param string $key
     * @return bool
     */
    protected function isSort(string $key): bool
    {
        return str_ends_with($key, '_sort');
    }

    /**
     * Determine if the filter key is a LIKE filter.
     *
     * @param string $key
     * @return bool
     */
    protected function isLike(string $key): bool
    {
        return str_ends_with($key, '_like');
    }

    /**
     * Determine if the filter key is an IN filter.
     *
     * @param string $key
     * @return bool
     */
    protected function isIn(string $key): bool
    {
        return str_ends_with($key, '_in');
    }
}
