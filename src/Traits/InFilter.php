<?php

namespace Sofronz\Elysia;

use Illuminate\Database\Eloquent\Builder;

trait InFilter
{
    protected function applyIn($value)
    {
        $field = str_replace('_in', '', $value);
        if ($this->isFillableField($field)) {
            $this->query->whereIn($field, explode(',', $value));
        }
    }
}