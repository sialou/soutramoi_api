<?php

namespace Database\Factories;
use App\Models\Abonnement;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Abonnement>
 */
class AbonnementFactory extends Factory
{
    //protected $model = Abonnement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /*'user_id' => fake()->user_id(),
            'job_id' => fake()->job_id(),
            'type_abonnement' => fake()->type_abonnement(),
            'created_at' => now(),*/
            'user_id' => $this->faker->randomNumber(), // Generate a random user ID
            'job_id' => $this->faker->randomNumber(), // Generate a random job ID
            'type_abonnement' => $this->faker->randomElement(['mensuel', 'trimestriel', 'annuel']), // Generate a random type of abonnement
            'created_at' => now(),
        ];
    }
}
