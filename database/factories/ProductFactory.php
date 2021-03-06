<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
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
            'name' => $this->faker->unique()->name(),
            'slug' => Str::slug($this->faker->name()),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->unique()->numberBetween(50, 100),
            'image' => 'https://source.unsplash.com/random/400',
        ];
    }
}
