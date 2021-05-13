<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    protected $seed = true;
    use RefreshDatabase;

    public function test_not_authenticated_page_contains_login_link()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('login');
    }

    public function test_not_authenticated_homepage_displays_product_name()
    {
        $product = Product::factory()->create();
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }
}
