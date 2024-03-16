<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_products(): void
    {
        $this->setUpTestCases();

        $response = $this->getJson("api/inventory");
        $response->assertStatus(200);
    }

    public function test_get_all_products_with_non_existent_categories(): void
    {
        $categories = "bazar-ramadan"; // non existent categories

        $response = $this->getJson("api/inventory?category={$categories}");
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The product category passed does not exist',
        ]);
    }

    public function test_store_a_product_successful()
    {
        $payload = [
            "title" => "This is a new product",
            "category" => "stationery",
        ];

        $initialProductCount = Product::count();
        $response = $this->postJson("api/add-inventory", $payload);
        $response->assertStatus(200);
        $this->assertEquals(Product::count(), $initialProductCount+1);
    }

    public function test_show_a_product_successful()
    {
        $response = $this->getJson("api/inventory/1");
        $response->assertStatus(200);
    }

    public function test_delete_a_product_successful()
    {
        $product = Product::latest()->first(); // get the last item 
        $response = $this->deleteJson("api/delete-inventory/{$product->id}");
        $response->assertStatus(200);
    }

    public function test_update_a_product_successful()
    {
        $payload = [
            "title" => "This is an updated product",
            "category" => "stationery",
        ];

        $product = Product::latest()->first(); // get the last item 

        $response = $this->putJson("api/update-inventory/{$product->id}", $payload);
        $response->assertStatus(200);
    }
}
