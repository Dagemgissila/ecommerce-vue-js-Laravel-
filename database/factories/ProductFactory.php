<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->text(),
            "image"=>fake()->imageUrl(),
            "description"=>fake()->realText(),
            "price"=>fake()->randomFloat(2,20,100),
            "created_at"=>now(),
            "updated_at"=>now(),
            "created_by"=>1,
            "updated_by"=>1

        ];
    }
}
