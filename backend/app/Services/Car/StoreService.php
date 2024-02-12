<?php

namespace App\Services\Car;

use App\BaseRepository\Services\StoreService as ServicesStoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class StoreService extends ServicesStoreService
{
    public function execute()
    {
        try {
            return parent::execute();
        } catch (\Throwable $th) {
            Log::error($th);

            throw $th;
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }
}
