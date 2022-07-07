<?php

namespace Database\Seeders;

use App\Models\MealHour;
use Illuminate\Database\Seeder;

class MealHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealHour::insert( [
            [
                'name'  => 'Almuerzo',
                'order' => 1,
            ],
            [
                'name'  => 'Cena',
                'order' => 2,
            ],
        ] );
    }
}
