<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;

class FilterBoolean extends AbsFilter
{
    public function execute($key, $value)
    {
        $this->builder->where($key, $value);
    }
}
