<?php

namespace App\Services\Car;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\Car\Aggregates\TDefaultAggregates;
use App\Services\Car\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultFilters, TDefaultAggregates;
}
