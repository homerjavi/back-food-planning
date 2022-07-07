<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Icon;
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
            'name'    => $this->faker->name,
            'icon_id' => Icon::inRandomOrder()->first()->id,
            'optimum_number' => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
