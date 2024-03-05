<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requete>
 */
class RequeteFactory extends Factory
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
            'hour' => fake()->hour(),
            'day' => fake()->day(),
            'type' => fake()->type(),
            'description' => fake()->description(),
        ];
    }
}
