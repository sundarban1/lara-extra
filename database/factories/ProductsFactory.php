<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
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
            'price' => fake()->numberBetween(1,100),
            'color' => fake()->colorName(),
            'description' => fake()->text(),
            'category' => fake()->name(),
            'size' => fake()->randomElement([
                'S', 'M','L', 'XL'
            ])
        ];
    }
}
