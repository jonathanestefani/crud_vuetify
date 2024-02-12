<?php

namespace App\Services\Car;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\Car\Filters\TDefaultFilters;
use App\Services\Car\Aggregates\TDefaultAggregates;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters, TDefaultAggregates;
}
