<?php

namespace App\Services\Company\Validator;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorService {

    private $validator = null;

    public function execute(Request $request) {
        $this->validator = Validator::make($request->all(), [
            'empresa' => 'required|integer|numeric',
            'sigla' => 'required|string',
            'razao_social' => 'required|string',
            'codigo' => 'required|duplicatecompany'
        ], [
            'empresa.required' => "Nome da empresa é obrigatório",
            'sigla.required' => "A sigla é obrigatório",
            'razao_social.required' => "A razão social é obrigatório",
            'codigo' => "Favor verificar o código da empresa, não pode existir duplicidade",
        ]);

        return $this->validator->fails();
    }

    public function validateDuplicateCompany($attribute, $value, $parameters, $validator) {
        $request = $validator->getData();

        if (isset($request["recnum"])) {
            return !Company::where('codigo', $request["codigo"])->where('recnum', '!=', $request["recnum"])->exists();
        } else {
            
            return !Company::where('codigo', $request["codigo"])->exists();
        }
    }

    public function getErrors() {
        return $this->validator->errors()->all();
    }

}
