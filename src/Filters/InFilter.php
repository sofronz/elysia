<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait InFilter
 *
 * This trait provides the functionality to filter query results based on the 'IN' condition.
 * It processes the query string parameters that end with '_in' and applies the 'whereIn' method
 * to the Eloquent query builder.
 *
 * The method `applyIn` will check if the field is fillable and then applies the filter to the query.
 * It expects a comma-separated list of values to match.
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
trait InFilter
{
    /**
     * Apply the 'IN' filter to the query.
     *
     * This method is used to filter the query results where the field matches one of the values in a list.
     *
     * @param string $value The value(s) for the filter, expected to be a comma-separated string.
     * @return void
     */
    protected function applyIn($field, $value)
    {
        // Remove the '_in' suffix from the filter key to get the actual field name
        $field = str_replace('_in', '', $field);

        // Check if the field is fillable in the model before applying the filter
        if ($this->isFillableField($field)) {
            // Apply the 'whereIn' condition to the query with the values provided
            $this->query->whereIn($field, explode(',', $value));
        }
    }
}
