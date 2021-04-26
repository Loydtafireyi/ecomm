<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
  
    public function test_admin_can_add_products()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['admin' => 1]);

        $response = $this->actingAs($user)->post('/admin/product/', [
            'name' => 'iPhone S',
            'description' => 'This is a new iphone',
            'price' => 50,
        ]);

        $response->assertRedirect(route('product.index'));
    }

    public function test_admin_can_edit_products()
    {
        $this->withExceptionHandling();

        $user = User::factory()->create(['admin' => 1]);

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->patch('/admin/product/' . $product->slug, [
            'name' => 'iPhone X',
            'description' => 'This is a d new iphone',
            'price' => 120,
            'slug' => $product->slug,
        ]);   

        $response->assertRedirect(route('product.index'));
    }

    public function test_admin_can_delete_product()
    {
        $user = User::factory()->create(['admin' => 1]);

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete('/admin/product/' . $product->slug);

        $product = $product->toArray();

        $this->assertDatabaseMissing('products', $product);

        $response->assertRedirect(route('product.index'));
    }

    public function test_non_admin_cannot_add_products()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/product/', [
            'name' => 'iPhone S',
            'description' => 'This is a new iphone',
            'price' => 50,
        ]);

        $response->assertStatus(401);

    }
}
