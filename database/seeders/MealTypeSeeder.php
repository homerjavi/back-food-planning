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
        MealType::create( [
            'name' => 'Todos',
            'order' => 1,
            'color' => '#ffffff'
        ] );
    }
}
