<?php

namespace App\Services\Company\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorService {

    private $validator = null;

    public function execute(Request $request) {
        $this->validator = Validator::make($request->all(), [
            'empresa' => 'required|integer|numeric',
            'sigla' => 'required|string',
            'razao_social' => 'required|string',
        ], [
            'empresa.required' => "Nome da empresa é obrigatório",
            'sigla.required' => "A sigla é obrigatório",
            'razao_social.required' => "A razão social é obrigatório"
        ]);

        return $this->validator->fails();
    }

    public function getErrors() {
        return $this->validator->errors()->all();
    }

}
