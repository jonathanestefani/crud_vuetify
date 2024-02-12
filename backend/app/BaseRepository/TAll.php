<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;

trait TAll 
{
    public function All()
    {
        if (method_exists($this, 'executeAggregate')) {
            $this->executeAggregate();
        }

        $this->beforeExecute(ETypeCall::ALL);

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters();
        }

        if (method_exists($this, 'executeOrder')) {
            $this->executeOrder();
        }

        $this->data = $this->instance->get();

        if (method_exists($this, 'loadRelationsByApi')) {
            $this->loadRelationsByApi();
        }

        $this->afterExecute(ETypeCall::ALL);

        return $this->data;
    }
}
