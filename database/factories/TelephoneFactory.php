<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TelephoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $faker->e164PhoneNumber,
            'phoneable_id' => function () {
                return factory(App\Parent::class)->create()->id;
            },
            'phoneable_type' => App\Parent::class,
        ];
    }
}
