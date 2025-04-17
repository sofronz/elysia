<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait InFilter
 *
 * Adds support for filtering Eloquent results using the "whereIn" condition
 * based on query parameters ending with "_in".
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
trait InFilter
{
    /**
     * Apply the "IN" filter to the query.
     *
     * @param string $field The filter key (e.g. 'status_in').
     * @param string $value Comma-separated values (e.g. 'active,pending').
     * @return void
     */
    protected function applyIn($field, $value)
    {
        $field = str_replace('_in', '', $field);

        if ($this->isFillableField($field)) {
            $this->query->whereIn($field, explode(',', $value));
        }
    }
}
