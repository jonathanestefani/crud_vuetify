<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;

class FilterNumber extends AbsFilter
{
    public function execute(String $key, $value)
    {
        if (gettype($value) === 'array') {
            $this->builder->whereIn($key, $value);
        } else {
            $this->builder->where($key, $value);
        }
    }
}
