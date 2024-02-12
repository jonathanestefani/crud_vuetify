<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\BaseRepository\Exceptions\ErrorCrudValidationException;

trait TCreate {

    public function create()
    {
        try {
            $this->crudValidation();

            $this->beforeExecute(EOperation::CREATE);

            $this->data = $this->modelClass::create($this->request)->refresh();

            $this->afterExecute(EOperation::CREATE);

            return $this->data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function crudValidation()
    {
        if (!isset($this->request)) {
            throw new ErrorBaseRepositoryException("Parâmetros não definidos");
        }

        try {
            foreach ($this->validationList as $validation) {
                if ($validation instanceof ICrudValidation) {
                    $validation->execute();
                }
            }
        } catch (ErrorCrudValidationException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}