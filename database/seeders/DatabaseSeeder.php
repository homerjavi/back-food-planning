<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Meal;
use App\Models\User;
//use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call( UserSeeder::class );
        $this->call( IconSeeder::class );
        $this->call( CategorySeeder::class );
        $this->call( MealSeeder::class );
        $this->call( MealTypeSeeder::class );
        $this->call( MealHourSeeder::class );
        /* Category::factory(10)->create();        
        Meal::factory(10)->create(); */
    }
}
