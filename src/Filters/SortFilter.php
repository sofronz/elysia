<?php

namespace Sofronz\Elysia\Filters;

/**
 * Trait SortFilter
 *
 * Adds support for sorting Eloquent results using query parameters ending with "_sort".
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
trait SortFilter
{
    /**
     * Apply the sorting to the query.
     *
     * @param string $field The filter key (e.g. 'created_at_sort').
     * @param string $value The sort direction (e.g. 'asc' or 'desc').
     * @return void
     */
    protected function applySort($field, $value)
    {
        $field = str_replace('_sort', '', $field);

        if ($this->isFillableField($field)) {
            $this->query->orderBy($field, $value);
        }
    }
}
