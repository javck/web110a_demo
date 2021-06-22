<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => rand(1,10),
            'name' => $this->faker->realText('10'),
            'enabled' => $this->faker->randomElement(array (1,0)),
            'sort' => $this->faker->numberBetween($min = 1, $max = 9000)
        ];
    }
}
