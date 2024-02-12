<?php

namespace App\BaseRepository\Services;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Services\IServices\IService;
use App\BaseRepository\TAll;
use App\BaseRepository\TFilters;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;

use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class ListAllService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TAll;

    public function execute()
    {
        try {
            return $this->All();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }
}
