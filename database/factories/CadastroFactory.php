<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cadastro>
 */
class CadastroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = fake()->randomElement(['cliente', 'fornecedor', 'prestador_servico', 'outros']);
        $isPessoaFisica = fake()->boolean(60);
        
        $categorias = [
            'cliente' => ['VIP', 'Regular', 'Eventual', 'Atacado', 'Varejo'],
            'fornecedor' => ['Padaria', 'Supermercado', 'Distribuidora', 'Atacadista', 'Importadora'],
            'prestador_servico' => ['Diarista', 'Eletricista', 'Encanador', 'TI', 'Contador', 'Advogado'],
            'outros' => ['Parceiro', 'Colaborador', 'Consultor', 'Freelancer']
        ];
        
        return [
            'nome' => $isPessoaFisica ? fake('pt_BR')->name() : fake('pt_BR')->company(),
            'tipo' => $tipo,
            'categoria' => fake()->randomElement($categorias[$tipo]),
            'cpf_cnpj' => $isPessoaFisica ? fake('pt_BR')->cpf(false) : fake('pt_BR')->cnpj(false),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake('pt_BR')->cellphoneNumber(),
            'whatsapp' => fake('pt_BR')->cellphoneNumber(),
            'endereco' => fake('pt_BR')->address(),
            'ativo' => fake()->boolean(90),
            'saldo_total' => fake()->randomFloat(2, 0, 50000),
        ];
    }
    
    /**
     * Cadastro do tipo cliente.
     */
    public function cliente(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'cliente',
            'categoria' => fake()->randomElement(['VIP', 'Regular', 'Eventual', 'Atacado', 'Varejo']),
        ]);
    }
    
    /**
     * Cadastro do tipo fornecedor.
     */
    public function fornecedor(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'fornecedor',
            'categoria' => fake()->randomElement(['Padaria', 'Supermercado', 'Distribuidora', 'Atacadista']),
        ]);
    }
    
    /**
     * Cadastro do tipo prestador de serviço.
     */
    public function prestadorServico(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'prestador_servico',
            'categoria' => fake()->randomElement(['Diarista', 'Eletricista', 'Encanador', 'TI', 'Contador']),
        ]);
    }
    
    /**
     * Cadastro inativo.
     */
    public function inativo(): static
    {
        return $this->state(fn (array $attributes) => [
            'ativo' => false,
        ]);
    }
}
