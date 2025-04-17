<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait SortFilter
 *
 * This trait provides the functionality to filter query results based on sorting.
 * It processes the query string parameters that end with '_sort' and applies the 'orderBy' method
 * to the Eloquent query builder.
 *
 * The method `applySort` will check if the field is fillable, determine the sort direction (ascending or descending),
 * and then applies the sorting to the query.
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
trait SortFilter
{
    /**
     * Apply the sorting filter to the query.
     *
     * This method is used to sort the query results by one or more fields.
     * The field(s) are passed in the query string, and the method determines
     * whether the sorting should be ascending or descending based on the field value.
     *
     * @param string $value The value representing the field(s) to sort by, comma-separated.
     * @return void
     */
    protected function applySort($field, $value)
    {
        // Remove any leading '-' to get the actual field name
        $field = str_replace('_sort', '', $field);
        
        // Apply the sorting to the query if the field is fillable
        if ($this->isFillableField($field)) {
            $this->query->orderBy($field, $value);
        }
    }
}
