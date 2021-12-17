<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create( [
            'name'    => 'Categoría 1',
            'icon_id' => Icon::first()->id,
        ] );
    }
}
