<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName,
            'second_name' => fake()->lastName,
            'other_name' => fake()->lastName,
            'email' => fake()->unique()->safeEmail,
            'telephone' => fake()->phoneNumber,
            'force_number' => fake()->randomNumber(5),
            'region' => fake()->word,
            'station' => fake()->word,
            'rank' => fake()->word,
            'directorate' => fake()->word,
            'office_role' => fake()->word,
            'password' => bcrypt('secret'),
            'status' => fake()->randomElement(['active', 'inactive'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
