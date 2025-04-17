<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait LikeFilter
 *
 * Adds support for filtering Eloquent results using the "LIKE" condition
 * based on query parameters ending with "_like".
 *
 * Author: Sofronius Ruddy  
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
trait LikeFilter
{
    /**
     * Apply the "LIKE" filter to the query.
     *
     * @param string $field The filter key (e.g. 'name_like').
     * @param string $value The value to search for (wrapped with % for LIKE condition).
     * @return void
     */
    protected function applyLike($field, $value)
    {
        $field = str_replace('_like', '', $field);

        if ($this->isFillableField($field)) {
            $this->query->where($field, 'like', '%' . $value . '%');
        }
    }
}