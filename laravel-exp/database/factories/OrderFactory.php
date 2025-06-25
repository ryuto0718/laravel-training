<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Product;

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
            'customer_id' => \App\Models\Customer::inRandomOrder()->first()?->id ?? \App\Models\Customer::factory(),
            'product_id' => \App\Models\Product::inRandomOrder()->first()?->id ?? \App\Models\Product::factory(),
            'order_date' => fake()->date(),
            'quantity' => $this->faker->numberBetween(1, 20),
        ];
    }
}
