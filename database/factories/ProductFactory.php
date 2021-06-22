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
            'name' => $this->faker->realText(10),
            'spec' => $this->faker->optional()->realText,
            'category_id' => rand(1,50),
            'price' => $this->faker->numberBetween(100,10000),
            'qty' => $this->faker->numberBetween(1,100),
            'pic' => $this->faker->imageUrl,
            'desc' => $this->faker->realText,
            'browse_count' => rand(0,1000000),
            'enabled' => rand(0,1),
            'hoted' => rand(0,1),
            'remark' => $this->faker->paragraph
        ];
    }
}
