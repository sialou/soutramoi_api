<?php

namespace Database\Factories;
use App\Models\Requete;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requete>
 */
class RequeteFactory extends Factory
{
    protected $model = Requete::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'created_at' => now(),
            'user_id' => $this->faker->randomNumber(), // Generate a random user ID
            'job_id' => $this->faker->randomNumber(), // Generate a random job ID
            'hour' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'), // Generate a random time (without date)
            'day' => $this->faker->date(),
            'type' => $this->faker->randomElement(['reservation', 'service_personnalise']), // Generate a random type
            'description' => $this->faker->text(),
        ];
    }
}
