<?php

namespace Sofronz\Elysia;

use Illuminate\Database\Eloquent\Builder;

trait LikeFilter
{
    protected function applyLike($value)
    {
        $field = str_replace('_like', '', $value);
        if ($this->isFillableField($field)) {
            $this->query->where($field, 'like', '%' . $value . '%');
        }
    }
}