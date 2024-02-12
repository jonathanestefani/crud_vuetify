<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\BaseRepository\Exceptions\ErrorCrudValidationException;

trait TCrud {
    // ICrudValidation
    private Array $validationList = [];

    public function addValidationList(Array $list) {
        $this->validationList = $list;
    }
}