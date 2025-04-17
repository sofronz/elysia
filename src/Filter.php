<?php
namespace Sofronz\Elysia;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    use SortFilter, LikeFilter, InFilter, FilterCheckerTrait;

    protected Request $request;
    protected Builder $query;
    protected array $filters = [];
    protected string $modelName;
    protected string $namespace;

    public function __construct(Request $request, string $modelName, string $namespace)
    {
        $this->request = $request;
        $this->modelName = $modelName;
        $this->namespace = $namespace;
    }

    public function apply(Builder $query): Builder
    {
        $this->query = $query;
        $this->filters = $this->request->query();

        $modelClass = "{$this->namespace}\\{$this->modelName}";
        $filterConfig = method_exists($modelClass, 'getQueryStringMapping') 
                        ? $modelClass::getQueryStringMapping() 
                        : [];

        foreach ($this->filters as $key => $value) {
            $field = $filterConfig[$key] ?? $key;

            if ($this->isSort($key)) {
                $this->applySort($value);
            } elseif ($this->isLike($key)) {
                $this->applyLike($value);
            } elseif ($this->isIn($key)) {
                $this->applyIn($value);
            } elseif ($this->isBasicWhere($key)) {
                $this->applyWhere($field, $value);
            }
        }

        return $this->query;
    }

    public function isFillableField(string $field): bool
    {
        return in_array($field, $this->query->getModel()->getFillable());
    }

    protected function isBasicWhere(string $key): bool
    {
        return in_array($key, $this->query->getModel()->getFillable());
    }

    protected function applyWhere($field, $value)
    {
        if ($this->isFillableField($field)) {
            $this->query->where($field, $value);
        }
    }
}
