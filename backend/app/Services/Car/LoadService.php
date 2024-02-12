<?php

namespace App\Services\Car;

use App\BaseRepository\Services\LoadService as ServicesLoadService;
use App\Services\Car\Aggregates\TDefaultAggregates;
use App\Services\Car\Filters\TDefaultFilters;

class LoadService extends ServicesLoadService
{
    use TDefaultFilters, TDefaultAggregates;
}
