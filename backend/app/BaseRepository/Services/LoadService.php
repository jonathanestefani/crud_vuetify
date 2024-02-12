<?php

namespace App\BaseRepository\Services;

use App\BaseRepository\Abs\ARepository;

use App\BaseRepository\Crud\TLoad;
use App\BaseRepository\TFilters;
use App\BaseRepository\TAggregate;
use App\BaseRepository\Services\IServices\IService;
use App\BaseRepository\THttpRequest;

use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class LoadService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TLoad;

    public function execute() {
        try {
            return $this->load($this->request["id"]);
        } catch (\Throwable $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        }
    }
}
