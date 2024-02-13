<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = array(
            array(
                "codigo" => 1,
                "recnum" => 21,
                "empresa" => 55,
                "sigla" => "GGG",
                "razao_social" => "RAZAO SOCIAL ssadasdassdad"
            ),
            array(
                "codigo" => 2,
                "recnum" => 3,
                "empresa" => 12,
                "sigla" => "BC",
                "razao_social" => "Empresa B Ltda"
            ),
            array(
                "codigo" => 4,
                "recnum" => 6,
                "empresa" => 1,
                "sigla" => "CD",
                "razao_social" => "Empresa D Ltda"
            ),
            array(
                "codigo" => 5,
                "recnum" => 7,
                "empresa" => 1,
                "sigla" => "DE",
                "razao_social" => "Empresa E Ltda"
            ),
            array(
                "codigo" => 6,
                "recnum" => 8,
                "empresa" => 1,
                "sigla" => "FG",
                "razao_social" => "Empresa F Ltda"
            ),
            array(
                "codigo" => 7,
                "recnum" => 11,
                "empresa" => 1,
                "sigla" => "HI",
                "razao_social" => "Empresa G Ltda"
            ),
            array(
                "codigo" => 8,
                "recnum" => 12,
                "empresa" => 1,
                "sigla" => "JI",
                "razao_social" => "Empresa H Ltda"
            ),
            array(
                "codigo" => 9,
                "recnum" => 13,
                "empresa" => 1,
                "sigla" => "IA",
                "razao_social" => "Empresa I Ltda"
            ),
            array(
                "codigo" => 11,
                "recnum" => 22,
                "empresa" => 1,
                "sigla" => "dfd",
                "razao_social" => "ssdsad"
            ),
            array(
                "codigo" => 12,
                "recnum" => 16,
                "empresa" => 1,
                "sigla" => "NA",
                "razao_social" => "Empresa N Ltda"
            ),
            array(
                "codigo" => 13,
                "recnum" => 17,
                "empresa" => 1,
                "sigla" => "OA",
                "razao_social" => "Empresa O Ltda"
            ),
            array(
                "codigo" => 14,
                "recnum" => 18,
                "empresa" => 1,
                "sigla" => "PA",
                "razao_social" => "Empresa P Ltda"
            ),
            array(
                "codigo" => 15,
                "recnum" => 19,
                "empresa" => 1,
                "sigla" => "QA",
                "razao_social" => "Empresa Q Ltda"
            ),
            array(
                "codigo" => 16,
                "recnum" => 20,
                "empresa" => 1,
                "sigla" => "RA",
                "razao_social" => "Empresa R Ltda"
            ),
            array(
                "codigo" => 21,
                "recnum" => 23,
                "empresa" => 1,
                "sigla" => "sadasd",
                "razao_social" => "sadsad"
            ),
            array(
                "codigo" => 22,
                "recnum" => 24,
                "empresa" => 1,
                "sigla" => "sads",
                "razao_social" => "sadsa"
            )
        );

        // Upsert dos dados
        foreach ($empresas as $dado) {
            Company::upsert(
                $dado, // Array de dados
                ['recnum'], // Chave única para verificar se já existe registro
                ['empresa', 'sigla', 'razao_social'] // Campos a serem atualizados se já existir registro
            );
        }
    }
}
