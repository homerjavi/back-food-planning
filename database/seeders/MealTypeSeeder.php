<?php

namespace Database\Seeders;

use App\Models\MealType;
use Illuminate\Database\Seeder;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealType::insert( [
            [
                'name' => 'Todos',
                'order' => 1,
                'color' => '#ffffff'
            ],
            [
                'name' => 'Lucas',
                'order' => 2,
                'color' => '#fff000'
            ],
            [
                'name' => 'Javi y Jessi',
                'order' => 3,
                'color' => '#000fff'
            ],
        ] );
    }
}
