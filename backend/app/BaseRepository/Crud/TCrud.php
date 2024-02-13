<?php

namespace App\BaseRepository\Crud;

trait TCrud {
    // ICrudValidation
    private Array $validationList = [];

    public function addValidationList(Array $list) {
        $this->validationList = $list;
    }
}