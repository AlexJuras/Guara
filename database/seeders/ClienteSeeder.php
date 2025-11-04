<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Cliente::create([
            'nome' => 'João Silva',
            'razao_social' => 'Silva & Cia Ltda',
            'cnpj' => '12345678000195',
            'tipo_cliente' => 'PESSOA_JURIDICA',
            'contato_responsavel' => 'João Silva',
            'endereco' => 'Rua das Flores, 123 - São Paulo/SP',
            'status' => true,
            'data_inicio_contrato' => '2024-01-15',
        ]);

        \App\Models\Cliente::create([
            'nome' => 'Maria Santos',
            'tipo_cliente' => 'PESSOA_FISICA',
            'contato_responsavel' => 'Maria Santos',
            'endereco' => 'Av. Brasil, 456 - Rio de Janeiro/RJ',
            'status' => true,
            'data_inicio_contrato' => '2024-02-10',
        ]);

        \App\Models\Cliente::create([
            'nome' => 'TechCorp',
            'razao_social' => 'TechCorp Soluções Digitais Ltda',
            'cnpj' => '98765432000123',
            'tipo_cliente' => 'PESSOA_JURIDICA',
            'contato_responsavel' => 'Carlos Eduardo',
            'endereco' => 'Rua da Tecnologia, 789 - Belo Horizonte/MG',
            'status' => true,
            'data_inicio_contrato' => '2024-03-05',
        ]);
    }
}
