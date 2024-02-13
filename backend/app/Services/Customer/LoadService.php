<?php

namespace App\Services\Customer;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Services\LoadService as ServicesLoadService;
use Illuminate\Http\Request;
use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class LoadService extends ServicesLoadService {
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

    public function execute() {
        try {
            return $this->data;
        } catch (\Throwable $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        }
    }

    public function openModel($recnum)
    {        
        try {
            $this->data = $this->instance->where('recnum', $recnum)->first();
\Log::info($this->data);
            $this->operation = EOperation::UPDATE;
        } catch (\Throwable $th) {
            Log::error($th);
            throw new ErrorServiceException("Houve um problema ao encontrar os dados na base de dados!");
        }

        return $this;
    }
}
