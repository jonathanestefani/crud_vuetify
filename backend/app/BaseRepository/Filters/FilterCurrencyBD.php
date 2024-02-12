<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;

class FilterCurrencyBD extends AbsFilter
{
    public function execute(string $key, $value)
    {
        if (gettype($value) === 'array') {
            $this->builder->whereIn($key, $value);
        } else {
            $this->builder->where($key, number_format($value, 2, '.', ''));
        }
    }
}
