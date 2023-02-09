<?php

namespace Database\Factories;

use App\Models\Suspect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image_path' => fake()->imageUrl(),
            'position' => fake()->randomDigitNotNull,
            'suspect_id' => function () {
                return Suspect::factory()->create()->id();
            },
        ];
    }
}
