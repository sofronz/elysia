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
    protected function applySort($value)
    {
        // Split the input value by comma to handle multiple sorting fields
        $fields = explode(',', $value);

        foreach ($fields as $field) {
            // Get the sort direction based on the field (ascending or descending)
            $direction = $this->getSortDirection($field);

            // Remove any leading '-' to get the actual field name
            $field = ltrim($field, '-');

            // Apply the sorting to the query if the field is fillable
            if ($this->isFillableField($field)) {
                $this->query->orderBy($field, $direction);
            }
        }
    }

    /**
     * Determine the sort direction (ascending or descending) for a given field.
     * 
     * This method checks whether the field starts with a '-' symbol.
     * If it does, the sorting direction is descending; otherwise, it's ascending.
     * 
     * @param string $field The field name to check for sorting direction.
     * @return string The sorting direction ('asc' or 'desc').
     */
    protected function getSortDirection(string $field): string
    {
        // Return 'desc' if the field starts with '-', otherwise 'asc'
        return str_starts_with($field, '-') ? 'desc' : 'asc';
    }
}