<?php

namespace Database\Seeders;

use App\Models\Tecnicos; // Importando o nome exato do seu Model
use Illuminate\Database\Seeder;

class TecnicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dados = [
            [
                'nome' => 'JF Impressoras & Suprimentos',
                'cnpj' => '12.345.678/0001-90',
                'regiao' => 'Belém - PA',
                'tipo' => 'Impressoras',
                'preco_atendimento' => 150.00,
                'contato' => '(91) 98888-7777',
            ],
            [
                'nome' => 'TechSolutions Informática',
                'cnpj' => '98.765.432/0001-10',
                'regiao' => 'Ananindeua - PA',
                'tipo' => 'Informatica',
                'preco_atendimento' => 120.00,
                'contato' => 'suporte@techsolutions.com',
            ],
            [
                'nome' => 'Marcos Vinícius (Freelancer)',
                'cnpj' => null,
                'regiao' => 'Castanhal - PA',
                'tipo' => 'Informatica',
                'preco_atendimento' => 200.00,
                'contato' => '(91) 99999-0000',
            ],
        ];

        foreach ($dados as $item) {
            Tecnicos::create($item);
        }
    }
}