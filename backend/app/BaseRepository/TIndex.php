<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;

trait TIndex 
{
    protected $perPageAttribute;
    protected $perPageDefault;
    protected $limit = 25;

    public function Index()
    {
        if (method_exists($this, 'executeAggregate')) {
            $this->executeAggregate();
        }

        $this->beforeExecute(ETypeCall::INDEX);

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters($this->request);
        }

        if (method_exists($this, 'executeOrder')) {
            $this->executeOrder();
        }

        $result = $this->executePagination()->toArray();

        $this->data = $result['data'];

        if (method_exists($this, 'loadRelationsByApi')) {
            $this->loadRelationsByApi();
        }

        unset($result['data']);
        $result['data'] = $this->data;
        $this->data = $result;

        $this->afterExecute(ETypeCall::INDEX);

        return $this->data;
    }

    private function executePagination()
    {
        $this->setPagination();

        $perPage = isset($this->request[$this->perPageAttribute])
            ? $this->request[$this->perPageAttribute]
            : $this->perPageDefault;

        if ($perPage == -1) {
            return $this->getStructPagination();
        }

        return $this->instance->paginate($perPage);
    }

    public function setPagination()
    {
        $currentPage = isset($this->request["page"]) ? $this->request["page"] : 1;

        $this->instance->skip($this->limit)->take($currentPage);
    }

    private function getStructPagination() {
        return [
            "current_page" => 1,
            "first_page_url" => "",
            "from" => "",
            "data" => $this->instance->get(),
            "total" => $this->instance->count(),
            "last_page" => 1,
            "last_page_url" => "",
            "links" => [],
            "from" => 1,
            "to" => 1,
            "per_page" => -1,
            "prev_page_url" => ""
        ];
    }
}
