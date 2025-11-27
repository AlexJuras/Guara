<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cadastro;
use App\Models\Cliente;
use App\Models\Conta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário de teste
        $user = User::factory()->create([
            'name' => 'Admin Guará',
            'email' => 'admin@guara.com',
            'password' => bcrypt('password'),
            'saldo' => 50000.00,
        ]);
        
        // Criar usuários adicionais
        $users = User::factory(3)->create();
        $allUsers = collect([$user])->concat($users);
        
        // Criar cadastros (fornecedores, clientes, prestadores)
        echo "Criando cadastros...\n";
        
        // 10 Clientes
        $cadastrosClientes = Cadastro::factory(10)->cliente()->create();
        
        // 8 Fornecedores
        $cadastrosFornecedores = Cadastro::factory(8)->fornecedor()->create();
        
        // 6 Prestadores de Serviço
        $cadastrosPrestadores = Cadastro::factory(6)->prestadorServico()->create();
        
        // 3 Outros
        $cadastrosOutros = Cadastro::factory(3)->create(['tipo' => 'outros']);
        
        // 2 Inativos
        $cadastrosInativos = Cadastro::factory(2)->inativo()->create();
        
        $allCadastros = $cadastrosClientes
            ->concat($cadastrosFornecedores)
            ->concat($cadastrosPrestadores)
            ->concat($cadastrosOutros)
            ->concat($cadastrosInativos);
        
        // Criar clientes
        echo "Criando clientes...\n";
        Cliente::factory(10)->privado()->create();
        Cliente::factory(5)->municipio()->create();
        Cliente::factory(3)->inativo()->create();
        
        // Criar contas de RECEITA
        echo "Criando contas de receita...\n";
        
        // Receitas pagas
        foreach ($allUsers as $usuario) {
            Conta::factory(8)
                ->receita()
                ->paga()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosClientes->random()->id,
                ]);
        }
        
        // Receitas pendentes
        foreach ($allUsers as $usuario) {
            Conta::factory(5)
                ->receita()
                ->pendente()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosClientes->random()->id,
                ]);
        }
        
        // Receitas recorrentes mensais
        foreach ($allUsers->take(2) as $usuario) {
            Conta::factory(3)
                ->receita()
                ->pendente()
                ->recorrente('mensal', 12)
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosClientes->random()->id,
                    'nome' => 'Assinatura Mensal',
                ]);
        }
        
        // Criar contas de DESPESA
        echo "Criando contas de despesa...\n";
        
        // Despesas pagas
        foreach ($allUsers as $usuario) {
            Conta::factory(10)
                ->despesa()
                ->paga()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosFornecedores->random()->id,
                ]);
        }
        
        // Despesas pendentes
        foreach ($allUsers as $usuario) {
            Conta::factory(6)
                ->despesa()
                ->pendente()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosFornecedores->random()->id,
                ]);
        }
        
        // Despesas vencidas
        foreach ($allUsers->take(2) as $usuario) {
            Conta::factory(3)
                ->despesa()
                ->vencida()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosFornecedores->random()->id,
                ]);
        }
        
        // Despesas recorrentes (contas fixas)
        $contasFixas = [
            ['nome' => 'Aluguel', 'valor' => 2500.00],
            ['nome' => 'Energia Elétrica', 'valor' => 450.00],
            ['nome' => 'Água', 'valor' => 180.00],
            ['nome' => 'Internet', 'valor' => 120.00],
        ];
        
        foreach ($allUsers->take(2) as $usuario) {
            foreach ($contasFixas as $conta) {
                Conta::factory()
                    ->despesa()
                    ->pendente()
                    ->recorrente('mensal', 12)
                    ->create([
                        'user_id' => $usuario->id,
                        'cadastro_id' => $cadastrosFornecedores->random()->id,
                        'nome' => $conta['nome'],
                        'valor' => $conta['valor'],
                        'categoria' => 'Contas Fixas',
                    ]);
            }
        }
        
        // Despesas com prestadores de serviço
        foreach ($allUsers as $usuario) {
            Conta::factory(4)
                ->despesa()
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $cadastrosPrestadores->random()->id,
                    'categoria' => 'Serviços',
                ]);
        }
        
        // Transferências
        echo "Criando transferências...\n";
        foreach ($allUsers->take(2) as $usuario) {
            Conta::factory(3)
                ->create([
                    'user_id' => $usuario->id,
                    'cadastro_id' => $allCadastros->random()->id,
                    'tipo' => 'transferencia',
                    'nome' => 'Transferência Bancária',
                    'categoria' => 'Bancária',
                ]);
        }
        
        echo "\n✅ Banco de dados populado com sucesso!\n";
        echo "📊 Resumo:\n";
        echo "   - Usuários: " . User::count() . "\n";
        echo "   - Cadastros: " . Cadastro::count() . "\n";
        echo "   - Clientes: " . Cliente::count() . "\n";
        echo "   - Contas: " . Conta::count() . "\n";
        echo "\n🔑 Credenciais de acesso:\n";
        echo "   Email: admin@guara.com\n";
        echo "   Senha: password\n\n";
    }
}
