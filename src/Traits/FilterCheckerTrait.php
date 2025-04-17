<?php

namespace Sofronz\Elysia\Traits;

/**
 * Trait FilterCheckerTrait
 * 
 * This trait provides helper methods to check the type of filter applied to the query string.
 * These methods are used to determine whether the filter is related to sorting, 
 * searching using LIKE, or filtering with IN for values.
 * 
 * Author: Sofronius Ruddy (GitHub: @sofronz)
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
trait FilterCheckerTrait
{
    /**
     * Check if the filter key is related to sorting.
     *
     * This function checks if the filter key ends with '_sort', indicating that 
     * the filter is related to sorting the query results.
     *
     * @param string $key The filter parameter name.
     * @return bool True if the filter is related to sorting, False otherwise.
     */
    protected function isSort(string $key): bool
    {
        return str_ends_with($key, '_sort');
    }

    /**
     * Check if the filter key is related to LIKE search.
     *
     * This function checks if the filter key ends with '_like', indicating that 
     * the filter is related to performing a LIKE search in the SQL query.
     *
     * @param string $key The filter parameter name.
     * @return bool True if the filter is related to LIKE search, False otherwise.
     */
    protected function isLike(string $key): bool
    {
        return str_ends_with($key, '_like');
    }

    /**
     * Check if the filter key is related to IN search.
     *
     * This function checks if the filter key ends with '_in', indicating that 
     * the filter is related to performing an IN search in the SQL query.
     *
     * @param string $key The filter parameter name.
     * @return bool True if the filter is related to IN search, False otherwise.
     */
    protected function isIn(string $key): bool
    {
        return str_ends_with($key, '_in');
    }
}