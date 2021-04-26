<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['admin' => 1]);
    } 
  
    public function test_admin_can_add_products()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->post('/admin/product/', [
            'name' => 'iPhone S',
            'description' => 'This is a new iphone',
            'price' => 50,
        ]);

        $response->assertRedirect(route('product.index'));
    }

    public function test_admin_can_view_products()
    {
        $this->withExceptionHandling();

        $product = Product::factory()->create();

        $this->actingAs($this->user)->get('/admin/product/')->assertSee($product->name);
    }

    public function test_admin_products_paginates_10_by_default()
    {
        Product::factory()->count(20)->create();

        $response = $this->actingAs($this->user)->get('/admin/product/');

        $response = $this->get(route('product.index'));
        $response->assertSee('Next');
    }

    public function test_admin_can_edit_products()
    {
        $this->withExceptionHandling();

        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->patch('/admin/product/' . $product->slug, [
            'name' => 'iPhone X',
            'description' => 'This is a d new iphone',
            'price' => 120,
            'slug' => $product->slug,
        ]);   

        $response->assertRedirect(route('product.index'));
    }

    public function test_admin_can_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->delete('/admin/product/' . $product->slug);

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
