<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use Exception;

class AllProductTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteProduct(){

        try{
            $category = Category::factory()->create();
            $product = Product::factory()->create(['category_id' => $category->id]);
            $response = $this->get(route('delete.product', $product->id));

            $response->assertStatus(302);

            $this->assertDatabaseMissing('products', ['id' => $product->id]);

        } catch (Exception $e) {
            dd($e);
        }
    }

}

