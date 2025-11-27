<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Cadastro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conta>
 */
class ContaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = fake()->randomElement(['receita', 'despesa', 'transferencia']);
        $status = fake()->randomElement(['pendente', 'pago', 'parcial', 'cancelado']);
        
        $nomes = [
            'receita' => ['Venda de Produtos', 'Prestação de Serviços', 'Comissão', 'Aluguel Recebido', 'Dividendos', 'Freelance'],
            'despesa' => ['Aluguel', 'Luz', 'Água', 'Internet', 'Telefone', 'Salários', 'Fornecedores', 'Combustível', 'Manutenção'],
            'transferencia' => ['Transferência Bancária', 'Transferência entre Contas', 'Depósito']
        ];
        
        $categorias = [
            'receita' => ['Vendas', 'Serviços', 'Investimentos', 'Aluguel', 'Outros'],
            'despesa' => ['Contas Fixas', 'Pessoal', 'Fornecedores', 'Operacional', 'Marketing', 'Impostos'],
            'transferencia' => ['Bancária', 'Interna']
        ];
        
        $metodosPagamento = ['Dinheiro', 'PIX', 'Cartão Crédito', 'Cartão Débito', 'Boleto', 'Transferência'];
        
        $dataVencimento = fake()->dateTimeBetween('-30 days', '+60 days');
        $dataPagamento = null;
        
        if ($status === 'pago') {
            // Se for conta paga, o vencimento deve ser no passado
            $dataVencimento = fake()->dateTimeBetween('-60 days', '-1 day');
            $dataPagamento = fake()->dateTimeBetween($dataVencimento, 'now');
        }
        
        return [
            'user_id' => User::factory(),
            'cadastro_id' => Cadastro::factory(),
            'nome' => fake()->randomElement($nomes[$tipo]),
            'tipo' => $tipo,
            'categoria' => fake()->randomElement($categorias[$tipo]),
            'valor' => fake()->randomFloat(2, 50, 5000),
            'status' => $status,
            'data_vencimento' => $dataVencimento,
            'data_pagamento' => $dataPagamento,
            'recorrente' => fake()->boolean(20),
            'recorrencia_tipo' => fake()->randomElement([null, 'diaria', 'semanal', 'mensal', 'anual']),
            'recorrencia_repeticoes' => fake()->optional(0.2)->numberBetween(2, 12),
            'metodo_pagamento' => fake()->randomElement($metodosPagamento),
            'descricao' => fake()->optional(0.5)->sentence(),
        ];
    }
    
    /**
     * Conta do tipo receita.
     */
    public function receita(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'receita',
            'nome' => fake()->randomElement(['Venda de Produtos', 'Prestação de Serviços', 'Comissão', 'Freelance']),
            'categoria' => fake()->randomElement(['Vendas', 'Serviços', 'Investimentos']),
        ]);
    }
    
    /**
     * Conta do tipo despesa.
     */
    public function despesa(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'despesa',
            'nome' => fake()->randomElement(['Aluguel', 'Luz', 'Água', 'Internet', 'Salários', 'Fornecedores']),
            'categoria' => fake()->randomElement(['Contas Fixas', 'Pessoal', 'Fornecedores', 'Operacional']),
        ]);
    }
    
    /**
     * Conta paga.
     */
    public function paga(): static
    {
        return $this->state(function (array $attributes) {
            $dataVencimento = fake()->dateTimeBetween('-60 days', '-1 day');
            return [
                'status' => 'pago',
                'data_vencimento' => $dataVencimento,
                'data_pagamento' => fake()->dateTimeBetween($dataVencimento, 'now'),
            ];
        });
    }
    
    /**
     * Conta pendente.
     */
    public function pendente(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pendente',
            'data_pagamento' => null,
            'data_vencimento' => fake()->dateTimeBetween('now', '+60 days'),
        ]);
    }
    
    /**
     * Conta vencida.
     */
    public function vencida(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pendente',
            'data_pagamento' => null,
            'data_vencimento' => fake()->dateTimeBetween('-30 days', '-1 day'),
        ]);
    }
    
    /**
     * Conta recorrente.
     */
    public function recorrente(string $tipo = 'mensal', int $repeticoes = 12): static
    {
        return $this->state(fn (array $attributes) => [
            'recorrente' => true,
            'recorrencia_tipo' => $tipo,
            'recorrencia_repeticoes' => $repeticoes,
        ]);
    }
}
