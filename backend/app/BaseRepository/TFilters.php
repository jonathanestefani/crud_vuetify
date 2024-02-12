<?php

namespace App\BaseRepository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait TFilters
{
    /* Define filters at Class */
    protected Array $filters = [];

    /* Internal use */
    protected Array $filtersRequest = [];

    public function setFilters(Array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    private function executeFilters(): Builder
    {
        if (method_exists($this, 'defineFilters')) {
            $this->defineFilters();
        }

        if (count($this->filtersRequest) > 0) 
        {
            foreach($this->filtersRequest as $key => $value) {
                try {
                    $listFilterClass = $this->filters[$key];

                    $listFilterClass->setFilters($this->filtersRequest)->setValue($value)->execute($this->instance);
                } catch (\Throwable $th) {
                    //throw $th;
                    Log::info($th);

                    Log::info("Houve um problema ao tentar encontrar ou executar o filtro $$key!");
                }
            }
        }

        return $this->instance;
    }

}
