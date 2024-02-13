<?php

namespace App\Services\Customer;

use App\BaseRepository\Services\StoreService as ServicesStoreService;
use Illuminate\Http\Request;
use App\BaseRepository\Enum\EOperation;
use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class StoreService extends ServicesStoreService 
{
    public function processRequest(Request &$request)
    {
        $this->request = $request->all();

        try {
            if (isset($this->request["recnum"])) {
                $this->openModel($this->request["recnum"]);
            } else {
                unset($this->request["recnum"]);
                $this->operation = EOperation::CREATE;        
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this;
    }

    public function execute()
    {
        try {
            switch ($this->operation) {
                case EOperation::CREATE:
                    return $this->create();
                    break;
                case EOperation::UPDATE:
                    return $this->update();
                    break;
            }
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }

    public function openModel($recnum)
    {        
        try {
            $this->data = $this->instance->where('recnum', $recnum)->get()->first();

            $this->operation = EOperation::UPDATE;
        } catch (\Throwable $th) {
            Log::error($th);
            throw new ErrorServiceException("Houve um problema ao encontrar os dados na base de dados!");
        }

        return $this;
    }
}
