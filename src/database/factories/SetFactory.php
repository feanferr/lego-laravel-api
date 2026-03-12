<?php

namespace Database\Factories;

use App\Models\Set;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Set>
 */
class SetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'theme' => $this->faker->randomElement([
                'Star Wars',
                'City',
                'Technic',
                'Harry Potter'
            ]),
            'year' => $this->faker->numberBetween(1990, 2024),
            'num_parts' => $this->faker->numberBetween(50, 2000),
            'image_url' => $this->faker->imageUrl()
        ];    
    }
}
