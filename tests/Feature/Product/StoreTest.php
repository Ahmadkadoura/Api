<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_store_product(): void
    {
        $category= Category::factory()->create();
        $product_data = [
            'scientific_name' => 'amjad',
            'trading_name' => 'ahmad',
            'date_of_validity' => date('2024-5-19'),
            'manufacturer' => 'amjad',
            'price' => 152,
            'available_quantity' => 12,
            'Category_id' => $category->id,
            'image' => 'amjad',
        ];
        $response = $this->postJson('api/products',$product_data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products',$product_data);
    }
}
