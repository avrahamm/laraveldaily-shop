<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
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

    public function test_edit_product_page_contains_product_data()
    {
        $productName = 'p11';
        $productPrice = 444;
        $product = Product::factory()->create([
            'name' => $productName,
            'price' => $productPrice,
            'description' => "aaa",
            'category_id' => 1,
        ]);
        $response = $this->actingAs($this->adminUser)->get("products/$product->id/edit");
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->price);
    }
}
