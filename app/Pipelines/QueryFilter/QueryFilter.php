<?php

namespace App\Pipelines\QueryFilter;

use App\Pipelines\QueryFilter\Contracts\ApplyFilter;
use Closure;

abstract class QueryFilter implements ApplyFilter
{
    protected $operator = '=';
    protected $filterName = null;
    protected $value = null;
    protected $builder = null;

    public function handle($request, Closure $next)
    {
        if (!request()->get($this->filterName())) {
            return $next($request);
        }
        $this->value = request($this->filterName());
        $this->builder = $next($request);
        return $this->applyFilter();
    }

    protected function filterName(): string
    {
        return !is_null($this->filterName) ? $this->filterName : \Str::snake(class_basename($this));
    }
}
