<?php

namespace App\Services\Customer\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidatorService {

    private $validator = null;

    public function execute(Request $request) {
        $this->validator = Validator::make($request->all(), [
            'codigo' => 'required|integer|numeric',
            'tipo' => 'required|string',
            'razao_social' => 'required|string',
            'cpf_cnpj' => 'required|string',
            'chave_composta_unico' => [
                Rule::unique('cliente')
                ->where('empresa', $request['empresa'])
                ->where('codigo', $request['codigo'])
                ->ignore('recnum'),
            ],
            'chave_composta_unico2' => [
                Rule::unique('cliente')
                ->where('empresa', $request['empresa'])
                ->where('codigo', $request['codigo'])
                ->where('recnum', '!=', $request['recnum'])
                ->whereNotNull('recnum'),
            ],
            /*
            'chave_composta_unico' => [ 
                Rule::unique('cliente')->where(function ($query) use ($request) {
                    \Log::info($request);
                    return $query->where('empresa', $request->all()["empresa"])->where("codigo", $request->all()["codigo"]);
                }),
            ],
            */
        ], [
            'codigo.required' => "Código é obrigatório",
            'tipo.required' => "O tipo é obrigatório",
            'razao_social.required' => "A razão social é obrigatório",
            'cpf_cnpj.required' => "O CPF/CNPJ é obrigatório",
            'chave_composta_unico' => "Favor verificar a empresa e código, não pode existir duplicidade, ",
            'chave_composta_unico2' => "Favor verificar a empresa e código, não pode existir duplicidade, "
        ]);

        return $this->validator->fails();
    }

    public function getErrors() {
        return $this->validator->errors()->all();
    }

}
