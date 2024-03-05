<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Abonnement>
 */
class AbonnementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => fake()->created_at(),
            'user_id' => fake()->user_id(),
            'job_id' => fake()->job_id(),
            'type_abonnement' => fake()->type_abonnement(),
        ];
    }
}
