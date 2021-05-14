<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $seed = true;
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $email = 'admin1@admin.com';
        $password = bcrypt('password123');
        // Create a user
        $this->user =  User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function test_login_redirects_successfully()
    {
        $response = $this->post('/login',[
            'email' => $this->user->email,
            'password' => $this->user->password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_authenticated_products_page_pagination()
    {
//        $products = Product::factory(4)->create(['price' => 400]);
        $products = Product::with('category')->get();
        $response = $this->actingAs($this->user)->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee($products->last()->name);
    }

    public function test_unauthenticated_user_cannot_access_products_page()
    {
        $response = $this->get('/products');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
