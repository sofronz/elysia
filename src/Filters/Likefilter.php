<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait LikeFilter
 *
 * This trait provides the functionality to filter query results based on a 'LIKE' condition.
 * It processes the query string parameters that end with '_like' and applies the 'where' method
 * with a 'LIKE' operator to the Eloquent query builder.
 *
 * The method `applyLike` will check if the field is fillable and then applies the filter to the query.
 * It expects a value that will be used to search the field with the 'LIKE' operator.
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/elysia. All rights reserved.
 */
trait LikeFilter
{
    /**
     * Apply the 'LIKE' filter to the query.
     *
     * This method is used to filter the query results where the field contains the provided value.
     * It uses the 'LIKE' SQL operator to match the field with the value.
     *
     * @param string $value The value to search within the field, which will be wrapped in '%' for 'LIKE' condition.
     * @return void
     */
    protected function applyLike($value)
    {
        // Remove the '_like' suffix from the filter key to get the actual field name
        $field = str_replace('_like', '', $value);

        // Check if the field is fillable in the model before applying the filter
        if ($this->isFillableField($field)) {
            // Apply the 'LIKE' condition to the query
            $this->query->where($field, 'like', '%' . $value . '%');
        }
    }
}
