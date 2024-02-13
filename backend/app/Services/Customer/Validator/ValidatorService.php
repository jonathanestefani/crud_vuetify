<?php

namespace App\Services\Customer\Validator;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorService {

    private $validator = null;

    public function execute(Request $request) {
        $validations = [
            'codigo' => 'required|integer|numeric',
            'tipo' => 'required|string',
            'razao_social' => 'required|string',
            'cpf_cnpj' => 'required|string',
            'empresa' => 'required|duplicatecustomer'
        ];

        $this->validator = Validator::make($request->all(), $validations, [
            'empresa' => "Favor verificar a empresa e código, não pode existir duplicidade",
            'codigo.required' => "Código é obrigatório",
            'tipo.required' => "O tipo é obrigatório",
            'razao_social.required' => "A razão social é obrigatório",
            'cpf_cnpj.required' => "O CPF/CNPJ é obrigatório",
        ]);

        $erros = $this->validator->fails();

        return $erros;
    }

    public function validateDuplicateCustomer($attribute, $value, $parameters, $validator) {
        $request = $validator->getData();

        if (isset($request["recnum"])) {
            return !Customer::where('codigo', $request["codigo"])->where('empresa', $request["empresa"])->where('recnum', '!=', $request["recnum"])->exists();
        } else {
            return !Customer::where('codigo', $request["codigo"])->where('empresa', $request["empresa"])->exists();
        }
    }

    public function getErrors() {
        return $this->validator->errors()->all();
    }

}
