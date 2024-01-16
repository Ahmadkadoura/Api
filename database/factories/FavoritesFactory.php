<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FavoritesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_favorite' => $this->faker->boolean(),
            'User_id'=> User::inRandomOrder()->first()->id,
            'product_id'=> product::factory()->create()->id,
        ];
    }
}
