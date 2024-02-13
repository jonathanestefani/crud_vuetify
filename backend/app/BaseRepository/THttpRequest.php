<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\EOperation;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;

trait THttpRequest
{
    protected Array $request = [];
    protected String $operation = "";

    public function setRequest(Request $request)
    {
        return $this->processRequest($request);
    }
    
    protected function processRequest(Request &$request) {
        $this->request = $request->all();

        $this->loadHttpFilters();
        $this->loadHttpAggregate();

        if (!is_array(app($this->modelClass)->getKeyName())) {
            if (isset($this->request[app($this->modelClass)->getKeyName()]) && $this->request[app($this->modelClass)->getKeyName()] != '0') 
                $this->openModelInstance($this->request[app($this->modelClass)->getKeyName()]);
        } else {
            if (!is_array(app($this->modelClass)->getKeyName()))
                unset($this->request[app($this->modelClass)->getKeyName()]);

            $this->operation = EOperation::CREATE;
        }

        return $this;
    }

    public function importRequest(Array $request)
    {
        $this->request = $request;

        $this->loadHttpFilters();
        $this->loadHttpAggregate();

        if (isset($this->request[app($this->modelClass)->getKeyName()]) && $this->request[app($this->modelClass)->getKeyName()] != '0') {
            $this->openModelInstance($this->request[app($this->modelClass)->getKeyName()]);
        } else {
            unset($this->request[app($this->modelClass)->getKeyName()]);

            $this->operation = EOperation::CREATE;
        }

        return $this;
    }

    private function loadHttpFilters() {
        if (method_exists($this, 'executeFilters')) {
            $this->filtersRequest = isset($this->request['filters']) && count($this->request['filters']) > 0 ? $this->request['filters'] : [];
        }
    }

    private function loadHttpAggregate() {
        if (method_exists($this, 'executeAggregate') ) {
            if (isset($this->request['with'])) {
                $this->with = isset($this->request['with']) && count($this->request['with']) > 0 ? $this->request['with'] : [];
            }

            $this->executeAggregate();
        }
    }

    public function setId($id) {
        $this->openModelInstance($id);

        return $this;
    }

    protected function openModelInstance($id)
    {
        /*
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }
        */
        if (!method_exists($this, 'load')) {
            $this->data = $this->instance->find($id);

            if (empty($this->data)) {
                throw new ErrorServiceException("Não foi possível encontrar os dados na base de dados!");
            }
    
            $this->operation = EOperation::UPDATE;
        }

        return $this;
    }
}
