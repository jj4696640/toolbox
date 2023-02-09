<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suspect>
 */
class SuspectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'case_ref' => fake()->randomNumber(),
            'station' => fake()->sentence(),
            'offence' => fake()->sentence(),
            'briefs_on_case' => fake()->text(),
            'name' => fake()->name(),
            'sex' => fake()->randomElement(['male', 'female']),
            'age' => fake()->numberBetween(18, 99),
            'nationality' => fake()->country(),
            'nin' => fake()->randomNumber(),
            'other_id_no' => fake()->randomNumber(),
            'tribe' => fake()->word(),
            'religion' => fake()->word(),
            'marital_status' => fake()->word(),
            'place_of_birth' => fake()->city(),
            'present_address' => fake()->address(),
            'distinguishing_features' => fake()->text(),
            'height' => fake()->randomFloat(),
            'bodybuild' => fake()->word(),
            'eye_color' => fake()->word(),
            'hair_color' => fake()->word(),
            'level_of_education' => fake()->word(),
            'languages_spoken' => fake()->words(),
            'travel_history' => fake()->text(),
            'previous_crime_records' => fake()->text(),
            'occupation' => fake()->word(),
            'user_id' => User::factory()->create()->id(),
        ];
    }
}