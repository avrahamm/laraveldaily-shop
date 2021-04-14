<?php

namespace Database\Factories;

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
            'photo' => $this->faker->imageUrl(),
            'description' => $this->faker->text,
            'category_id' => $this->faker->numberBetween(1,4),
//            'category_id' => 1,
        ];
    }
}
