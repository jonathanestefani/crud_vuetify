<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Enum\ETypeCall;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;

trait TLoad {

    public function load($id)
    {
        try {
            $this->operation = EOperation::LOAD;

            if (method_exists($this, 'executeAggregate')) {
                $this->executeAggregate();
            }

            $this->beforeExecute(ETypeCall::SHOW);

            $this->data = $this->instance->find($id);

            if (method_exists($this, 'loadRelationsByApi')) {
                $this->loadRelationsByApi();
            }

            $this->afterExecute(ETypeCall::ALL);

            if (empty($this->instance)) {
                throw new ErrorBaseRepositoryException("Não foi possível encontrar os dados na base de dados!");
            }

            return $this->data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}