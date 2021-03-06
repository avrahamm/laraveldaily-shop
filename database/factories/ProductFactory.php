<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'price' => $this->faker->randomNumber(3),
            'photo' => Product::$defaultPhoto,
            'description' => $this->faker->text,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
