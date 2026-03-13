<?php

namespace Database\Seeders;

use App\Models\Clientes;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar um Ministério (Pai)
        $mte = Clientes::create([
            'nome'     => 'Ministério do Trabalho e Emprego - MTE',
            'tipo'     => 'ministerio',
            'cnpj'     => '00.394.460/0001-41',
            'contrato' => 'IP',
            'estado'   => 'DF',
            'cidade'   => 'Brasília',
            'endereco' => 'Esplanada dos Ministérios, Bloco F',
            'sla'      => ['Atendimento' => 4, 'Insumos' => 24, 'Substituição' => 48, 'Tipo' => 'Original'],
            'parent_id' => null,
        ]);

        // 2. Criar Unidades vinculadas ao MTE (Filhos)
        Clientes::create([
            'nome'      => 'MTE - Superintendência Caxias do Sul',
            'tipo'      => 'unidade',
            'parent_id' => $mte->id, // Vincula ao ID do pai acima
            'cnpj'      => '00.394.460/0050-20',
            'contrato'  => 'Alucom',
            'estado'    => 'RS',
            'cidade'    => 'Caxias do Sul',
            'endereco'  => 'Rua Dr. Montaury, 123',
            'sla'       => ['Atendimento' => 8, 'Insumos' => 48, 'Substituição' => 72, 'Tipo' => 'Compativel'],
        ]);

        Clientes::create([
            'nome'      => 'MTE - Gerência Regional de Fortaleza',
            'tipo'      => 'unidade',
            'parent_id' => $mte->id,
            'cnpj'      => '00.394.460/0080-90',
            'contrato'  => 'Moreia',
            'estado'    => 'CE',
            'cidade'    => 'Fortaleza',
            'endereco'  => 'Rua 24 de Maio, 178',
            'sla'       => ['Atendimento' => 4, 'Insumos' => 24, 'Substituição' => 48, 'Tipo' => 'Original'],
        ]);

        // 3. Criar outro Ministério para teste
        $mec = Clientes::create([
            'nome'     => 'Ministério da Educação - MEC',
            'tipo'     => 'ministerio',
            'cnpj'     => '00.394.445/0001-34',
            'contrato' => 'ZapLoc',
            'estado'   => 'DF',
            'cidade'   => 'Brasília',
            'endereco' => 'Esplanada dos Ministérios, Bloco L',
            'sla'      => ['Atendimento' => 4, 'Insumos' => 12, 'Substituição' => 24, 'Tipo' => 'Original'],
        ]);
    }
}