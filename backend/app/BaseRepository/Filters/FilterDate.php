<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;

class FilterDate extends AbsFilter
{
    public function execute(String $key, $value)
    {
        if (isset($value["start"]) && isset($value["final"])) {
            $this->builder->whereBetween($key, [$value["start"], $value["final"]]);
        } else {
            $this->builder->whereRaw('date(' . $key . ') = ?', $value);
        }
    }
}
