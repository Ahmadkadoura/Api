<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scientific_name' => $this->faker->word(),
            'trading_name' => $this->faker->unique()->word(),
            'manufacturer' => $this->faker->word(),
            'Date_of_validity' => $this->faker->date(),
            'quantity' =>  random_int(1,250),
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => $this->faker->word (),
            'price' => rand(1000, 99999),
        ];
    }
}
