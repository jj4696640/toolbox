<?php

namespace Database\Factories;

use App\Models\Suspect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Associate>
 */
class AssociateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'residence' => fake()->address(),
            'suspect_id' => function () {
                return Suspect::factory()->create()->id();
            },
        ];
    }
}
