<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SuspectParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $faker->name,
            'residence' => $faker->address,
            'suspect_id' => function () {
                return factory(App\Suspect::class)->create()->id;
            },
        ];
    }
}
