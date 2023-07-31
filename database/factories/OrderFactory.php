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
        $amount = $this->faker->numberBetween(1, 10);
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'amount' => $amount,
            'cost' => $amount * $this->faker->numberBetween(4, 9),
            'completed' => true,
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
