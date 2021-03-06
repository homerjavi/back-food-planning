<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::create( [
            'name' => 'Huevo con patatas',
            'category_id' => Category::first()->id,
        ] );
    }
}
