<?php

namespace Sofronz\Elysia;

trait FilterCheckerTrait
{
    protected function isSort(string $key): bool
    {
        return str_ends_with($key, '_sort');
    }

    protected function isLike(string $key): bool
    {
        return str_ends_with($key, '_like');
    }

    protected function isIn(string $key): bool
    {
        return str_ends_with($key, '_in');
    }
}