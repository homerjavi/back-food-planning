<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icon::insert( [
            [
                'name' => 'Pollo color 1',
                'path' => 'storage/images/icons/pollo-color-1.png',
            ],
            [
                'name' => 'Pollo color 2',
                'path' => 'storage/images/icons/pollo-color-2.png',
            ],
            [
                'name' => 'Pollo bn 1',
                'path' => 'storage/images/icons/pollo-bn-1.png',
            ],
            [
                'name' => 'Pollo bn 2',
                'path' => 'storage/images/icons/pollo-bn-2.png',
            ],
            [
                'name' => 'Ternera color 1',
                'path' => 'storage/images/icons/ternera-color-1.png',
            ],
            [
                'name' => 'Ternera color 2',
                'path' => 'storage/images/icons/ternera-color-2.png',
            ],
            [
                'name' => 'Ternera bn 1',
                'path' => 'storage/images/icons/ternera-bn-1.png',
            ],
            [
                'name' => 'Ternera bn 2',
                'path' => 'storage/images/icons/ternera-bn-2.png',
            ],
            [
                'name' => 'Cerdo color 1',
                'path' => 'storage/images/icons/cerdo-color-1.png',
            ],
            [
                'name' => 'Cerdo color 2',
                'path' => 'storage/images/icons/cerdo-color-2.png',
            ],
            [
                'name' => 'Cerdo bn 1',
                'path' => 'storage/images/icons/cerdo-bn-1.png',
            ],
            [
                'name' => 'Cerdo bn 2',
                'path' => 'storage/images/icons/cerdo-bn-2.png',
            ],
            [
                'name' => 'Pescado color 1',
                'path' => 'storage/images/icons/pescado-color-1.png',
            ],
            [
                'name' => 'Pescado color 2',
                'path' => 'storage/images/icons/pescado-color-2.png',
            ],
            [
                'name' => 'Pescado bn 1',
                'path' => 'storage/images/icons/pescado-bn-1.png',
            ],
            [
                'name' => 'Pescado bn 2',
                'path' => 'storage/images/icons/pescado-bn-2.png',
            ],
            [
                'name' => 'Arroz 1',
                'path' => 'storage/images/icons/arroz-1.png',
            ],
            [
                'name' => 'Arroz 2',
                'path' => 'storage/images/icons/arroz-2.png',
            ],
            [
                'name' => 'Pasta 1',
                'path' => 'storage/images/icons/pasta-1.png',
            ],
            [
                'name' => 'Pasta 2',
                'path' => 'storage/images/icons/pasta-2.png',
            ],
            [
                'name' => 'Postre 1',
                'path' => 'storage/images/icons/postre-1.png',
            ],
            [
                'name' => 'Postre 2',
                'path' => 'storage/images/icons/postre-2.png',
            ],
        ] );
    }
}
