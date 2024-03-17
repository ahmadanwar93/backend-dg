<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExtendedProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_products(): void
    {
        $this->setUpTestCases();
        $user = User::first();

        $response = $this->getJson("api/{$user->id}/inventory");
        $response->assertStatus(200);
    }

    public function test_get_all_products_with_non_existent_categories(): void
    {
        $categories = "bazar-ramadan"; // non existent categories
        $user = User::first();

        $response = $this->getJson("api/{$user->id}/inventory?category={$categories}");
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The product category passed does not exist',
        ]);
    }

    public function test_store_a_product_failed_without_permissions()
    {
        $payload = [
            "title" => "This is a new product",
            "category" => "Stationery",
        ];

        $user = User::find(1);

        $response = $this->postJson("api/{$user->id}/add-inventory", $payload);
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'The user do not have the authorization to access the resource',
        ]);
    }

    public function test_store_a_product_successful_with_permissions()
    {
        $payload = [
            "title" => "This is a new product",
            "category" => "Stationery",
        ];

        $user = User::find(2);

        $initialProductCount = Product::count();
        $response = $this->postJson("api/{$user->id}/add-inventory", $payload);
        $response->assertStatus(200);
        $this->assertEquals(Product::count(), $initialProductCount+1);
    }

    public function test_show_a_product_successful_with_permission()
    {
        $user = User::find(2);
        $product = Product::latest()->first();
        
        $response = $this->getJson("api/{$user->id}/inventory/{$product->id}");
        $response->assertStatus(200);
    }

    public function test_delete_a_product_successful_with_permission()
    {
        $user = User::find(2);

        $initialProductCount = Product::count();
        $product = Product::latest()->first(); // get the last item 
        $response = $this->deleteJson("api/{$user->id}/delete-inventory/{$product->id}");
        $response->assertStatus(200);
        $this->assertEquals(Product::count(), $initialProductCount-1);
    }
    
    public function test_delete_a_product_failed_without_permission()
    {
        $user = User::find(1);
        
        $product = Product::latest()->first(); // get the last item 
        $response = $this->deleteJson("api/{$user->id}/delete-inventory/{$product->id}");
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'The user do not have the authorization to access the resource',
        ]);
    }

    public function test_update_a_product_successful_with_permission()
    {
        $payload = [
            "title" => "This is an updated product",
            "category" => "Stationery",
        ];
        $user = User::find(2);

        $product = Product::latest()->first(); // get the last item 

        $response = $this->putJson("api/{$user->id}/update-inventory/{$product->id}", $payload);
        $response->assertStatus(200);
    }

    public function test_update_a_product_failed_without_permission()
    {
        $payload = [
            "title" => "This is an updated product",
            "category" => "Stationery",
        ];
        $user = User::find(1);

        $product = Product::latest()->first(); // get the last item 

        $response = $this->putJson("api/{$user->id}/update-inventory/{$product->id}", $payload);
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'The user do not have the authorization to access the resource',
        ]);
    }
}
