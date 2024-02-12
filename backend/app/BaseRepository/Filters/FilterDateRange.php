<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;

class FilterDateRange extends AbsFilter
{
    public function execute(String $key, $value)
    {
        if (empty($value["start"]) || empty($value["final"])) {
            $this->builder;
        } else {
            $startValue = $value["start"];
            $datetimeStartValue = "$startValue 00:00";

            $finalValue = $value["final"];
            $datetimeFinalValue = "$finalValue 23:59";

            $this->builder->whereBetween($key, [$datetimeStartValue, $datetimeFinalValue]);
        }
    }
}
