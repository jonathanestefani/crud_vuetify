<?php

namespace App\Services\Customer;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Services\DestroyService as ServicesDestroyService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DestroyService extends ServicesDestroyService {
    public function processRequest(Request &$request)
    {
        $this->request = $request->all();

        try {
            if (isset($this->request["empresa"]) && isset($this->request["codigo"])) {
                $this->openModel($this->request["empresa"], $this->request["codigo"]);
            } else {
                throw new ErrorServiceException("Houve um problema ao encontrar os dados na base de dados!");
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this;
    }

    public function execute()
    {
        try {
            $this->destroy();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }

    public function openModel($empresa, $codigo)
    {        
        try {
            $this->data = $this->instance->where('empresa', $empresa)->where('codigo', $codigo)->get()->first();

            $this->operation = EOperation::UPDATE;
        } catch (\Throwable $th) {
            Log::error($th);
            throw new ErrorServiceException("Houve um problema ao encontrar os dados na base de dados!");
        }

        return $this;
    }
}
