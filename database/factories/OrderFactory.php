<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomNumber(),
            'cost' => $this->faker->randomNumber(),
        ];
    }

    public function configure()
    {
        //after creating make 3 coffees that have the same order_id and user_id
        return $this->afterCreating(function (\App\Models\Order $order) {
            \App\Models\Coffee::factory()->count(3)->create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ]);
        });
    }
}
