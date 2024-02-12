<?php

namespace App\Services\Car\Aggregates;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = ["country", "state", "city"];
    }
}
