<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultas>
 */
class ConsultasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            "data_consulta" => fake()->date(),
            "paciente_id" => fake()->numberBetween(1,10),
            "profissional_id" => fake()->numberBetween(1,10),
        ];
    }
}