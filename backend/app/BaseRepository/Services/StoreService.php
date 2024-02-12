<?php

namespace App\BaseRepository\Services;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCreate;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Crud\TUpdate;
use App\BaseRepository\Services\IServices\IService;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;

use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class StoreService extends ARepository implements IService
{
    use THttpRequest, TCrud, TCreate, TUpdate;

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

}
