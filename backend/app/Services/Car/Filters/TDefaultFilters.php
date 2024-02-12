<?php

namespace App\Services\Car\Filters;

use App\BaseRepository\Filters\FilterNumber;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "id" => new ListFilter(FilterNumber::class, "id"),
            "name" => new ListFilter(FilterStringLike::class, "name")
        ];
    }
}
