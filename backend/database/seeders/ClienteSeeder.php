<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = array(
            array(
                "recnum" => 8,
                "empresa" => 2,
                "codigo" => 1,
                "razao_social" => "Razão social tsdasdsdds",
                "tipo" => "PF",
                "cpf_cnpj" => "12345678901"
            ),
            array(
                "recnum" => 16,
                "empresa" => 2,
                "codigo" => 2,
                "razao_social" => "dasds",
                "tipo" => "PF",
                "cpf_cnpj" => "12345678901"
            ),
            array(
                "recnum" => 15,
                "empresa" => 2,
                "codigo" => 3,
                "razao_social" => "asdsa",
                "tipo" => "PJ",
                "cpf_cnpj" => "1234579"
            ),
            array(
                "recnum" => 21,
                "empresa" => 2,
                "codigo" => 5,
                "razao_social" => "joanthan",
                "tipo" => "PF",
                "cpf_cnpj" => "123456789"
            ),
            array(
                "recnum" => 22,
                "empresa" => 2,
                "codigo" => 6,
                "razao_social" => "ssss",
                "tipo" => "PF",
                "cpf_cnpj" => "123456"
            ),
            array(
                "recnum" => 33,
                "empresa" => 2,
                "codigo" => 8,
                "razao_social" => "sda",
                "tipo" => "PJ",
                "cpf_cnpj" => "12321"
            ),
            array(
                "recnum" => 35,
                "empresa" => 2,
                "codigo" => 11,
                "razao_social" => "Empresa de teste",
                "tipo" => "PJ",
                "cpf_cnpj" => "1234567901"
            ),
            array(
                "recnum" => 9,
                "empresa" => 4,
                "codigo" => 1,
                "razao_social" => "razão social update",
                "tipo" => "PF",
                "cpf_cnpj" => "12345678901"
            ),
            array(
                "recnum" => 10,
                "empresa" => 4,
                "codigo" => 2,
                "razao_social" => "Razão social 3",
                "tipo" => "PF",
                "cpf_cnpj" => "12345678901"
            )
        );

        // Upsert dos dados
        foreach ($clientes as $dado) {
            Customer::upsert(
                $dado, // Array de dados
                ['recnum'], // Chave única para verificar se já existe registro
                ['codigo', 'empresa', 'tipo', 'razao_social', 'cpf_cnpj'] // Campos a serem atualizados se já existir registro
            );
        }
    }
}
