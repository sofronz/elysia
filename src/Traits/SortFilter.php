<?php 

namespace Sofronz\Elysia;

use Illuminate\Database\Eloquent\Builder;

trait SortFilter
{
    protected function applySort($value)
    {
        $fields = explode(',', $value);
        foreach ($fields as $field) {
            $direction = $this->getSortDirection($field);
            $field = ltrim($field, '-');

            if ($this->isFillableField($field)) {
                $this->query->orderBy($field, $direction);
            }
        }
    }

    protected function getSortDirection(string $field): string
    {
        return str_starts_with($field, '-') ? 'desc' : 'asc';
    }
}