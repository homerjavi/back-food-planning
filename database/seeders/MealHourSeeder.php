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
        MealHour::create( [
            'name'  => 'Almuerzo',
            'order' => 1,
        ] );
    }
}
