<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipoCliente = fake()->randomElement(['municipio', 'privado']);
        $isPrivado = $tipoCliente === 'privado';
        
        return [
            'nome' => $isPrivado ? fake('pt_BR')->company() : 'Prefeitura de ' . fake('pt_BR')->city(),
            'razao_social' => $isPrivado ? fake('pt_BR')->company() . ' LTDA' : null,
            'cnpj' => fake('pt_BR')->cnpj(false),
            'tipo_cliente' => $tipoCliente,
            'contato_responsavel' => fake('pt_BR')->name(),
            'endereco' => fake('pt_BR')->address(),
            'status' => fake()->boolean(90),
            'data_inicio_contrato' => fake()->dateTimeBetween('-2 years', '-6 months'),
            'data_fim_contrato' => fake()->optional(0.7)->dateTimeBetween('+6 months', '+3 years'),
        ];
    }
    
    /**
     * Cliente inativo.
     */
    public function inativo(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
    
    /**
     * Cliente do tipo município.
     */
    public function municipio(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cliente' => 'municipio',
            'nome' => 'Prefeitura de ' . fake('pt_BR')->city(),
            'razao_social' => null,
        ]);
    }
    
    /**
     * Cliente privado (empresa).
     */
    public function privado(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cliente' => 'privado',
            'nome' => fake('pt_BR')->company(),
            'razao_social' => fake('pt_BR')->company() . ' LTDA',
        ]);
    }
}
