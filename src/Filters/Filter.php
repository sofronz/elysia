<?php

/**
 * Class Filter
 *
 * Core class for handling query string filtering in Eloquent models.
 *
 * Author: Sofronius Ruddy
 * Copyright (c) 2025 Sofronz/Elysia. All rights reserved.
 */
namespace Sofronz\Elysia\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Sofronz\Elysia\Traits\FilterCheckerTrait;

class Filter
{
    use SortFilter, LikeFilter, InFilter, FilterCheckerTrait;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * @var array
     */
    protected array $filters = [];

    /**
     * @var string
     */
    protected string $modelName;

    /**
     * @var string
     */
    protected string $namespace;

    /**
     * Filter constructor.
     *
     * @param Request $request The HTTP request instance.
     * @param string $modelClass The model class to apply filters to (e.g., Model::class).
     */
    public function __construct(Request $request, string $modelClass)
    {
        $this->request   = $request;
        $this->modelName = class_basename($modelClass);
        $this->namespace = dirname($modelClass);
    }

    /**
     * Apply filters to the query based on the request parameters.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query builder with applied filters.
     */
    public function apply(Builder $query): Builder
    {
        $this->query   = $query;
        $this->filters = $this->request->query();

        // Get the model class dynamically
        $modelClass   = "{$this->namespace}\\{$this->modelName}";
        $filterConfig = method_exists($modelClass, 'getQueryStringMapping')
                        ? $modelClass::getQueryStringMapping()
                        : [];

        // Loop through each filter from the request
        foreach ($this->filters as $key => $value) {
            $filteredField = array_search($key, $filterConfig);
            $field         = $filteredField !== false ? $filteredField : $key;
            
            // Using match expression to determine filter type
            match (true) {
                $this->isSort($field)       => $this->applySort($field, $value),
                $this->isLike($field)       => $this->applyLike($field, $value),
                $this->isIn($field)         => $this->applyIn($field, $value),
                $this->isBasicWhere($field) => $this->applyWhere($field, $value),
                default                     => $this->applyWhere($field, $value),
            };
        }

        return $this->query;
    }

    /**
     * Check if the field is fillable in the model.
     *
     * @param string $field The field to check.
     * @return bool Whether the field is fillable.
     */
    public function isFillableField(string $field): bool
    {
        return in_array($field, $this->query->getModel()->getFillable());
    }

    /**
     * Check if the filter key corresponds to a basic where condition.
     *
     * @param string $key The filter key.
     * @return bool Whether the filter corresponds to a basic where.
     */
    protected function isBasicWhere(string $key): bool
    {
        return in_array($key, $this->query->getModel()->getFillable());
    }

    /**
     * Apply a basic where condition to the query.
     *
     * @param string $field The field to filter by.
     * @param mixed $value The value to filter with.
     */
    protected function applyWhere($field, $value)
    {
        if ($this->isFillableField($field)) {
            $this->query->where($field, $value);
        }
    }
}
