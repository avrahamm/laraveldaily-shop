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

    private $notAdminUser;
    private $adminUser;

    public function setUp(): void
    {
        parent::setUp();
        $email = 'user@user.com';
        $password = bcrypt('password');
        // Create a user
        $this->notAdminUser =  User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);

        $adminEmail = 'admin1@user.com';
        $adminPassword = bcrypt('password123');
        // Create a user
        $this->adminUser =  User::factory()->create([
            'email' => $adminEmail,
            'password' => $adminPassword,
            'is_admin' => 1
        ]);
    }

    public function test_login_redirects_successfully()
    {
        $response = $this->post('/login',[
            'email' => $this->notAdminUser->email,
            'password' => $this->notAdminUser->password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_authenticated_products_page_pagination()
    {
//        $products = Product::factory(4)->create(['price' => 400]);
        $products = Product::with('category')->get();
        $response = $this->actingAs($this->notAdminUser)->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee($products->last()->name);
    }

    public function test_unauthenticated_user_cannot_access_products_page()
    {
        $response = $this->get('/products');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_admin_user_can_see_new_product_button()
    {
        $response = $this->actingAs($this->adminUser)->get('/products');
        $response->assertStatus(200);
        $response->assertSee('New Product');
    }

    public function test_not_admin_user_can_not_see_new_product_button()
    {
        $response = $this->actingAs($this->notAdminUser)->get('/products');
        $response->assertStatus(200);
        $response->assertDontSee('New Product');
    }

    public function test_store_product_exists_in_database()
    {
        $productName = 'p11';
        $productPrice = 444;
        $response = $this->actingAs($this->adminUser)->post('products', [
            'name' => $productName,
            'price' => $productPrice,
            'description' => "aaa",
            'category_id' => 1,
        ]);

        $response->assertRedirect('products');
        $this->assertDatabaseHas('products', ['name' => $productName, 'price' => $productPrice]);

        $product = Product::orderBy('id', 'desc')->first();
        $this->assertEquals($productName, $product->name);
        $this->assertEquals($productPrice, $product->price);
    }
}
