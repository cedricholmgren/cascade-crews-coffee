<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coffee>
 */
class CoffeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['latte', 'cappuccino', 'americano', 'espresso', 'mocha', 'macchiato', 'black coffee', 'cold brew', 'iced coffee', 'I would rather wrestle Leif']),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'note' => $this->faker->text,
        ];
    }
}
