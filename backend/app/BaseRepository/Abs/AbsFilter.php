<?php

namespace App\BaseRepository\Abs;

use Illuminate\Database\Eloquent\Builder;

abstract class AbsFilter
{
    protected $builder;
    protected Array $filters;

    public function __construct(Builder &$builder)
    {
        $this->builder = $builder;
    }

    abstract public function execute(String $key, $value);

    public function setFilters(Array $filters) {
        $this->filters = $filters;

        return $this;
    }
}
