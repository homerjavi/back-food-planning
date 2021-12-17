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
                'name' => 'Comida',
                'path' => 'storage/images/icons/comida.png',
            ],
            [
                'name' => 'Pollo 1',
                'path' => 'storage/images/icons/pollo-1.png',
            ],
            [
                'name' => 'Pollo 2',
                'path' => 'storage/images/icons/pollo-2.png',
            ],
            [
                'name' => 'Ternera 1',
                'path' => 'storage/images/icons/ternera-1.png',
            ],
            [
                'name' => 'Ternera 2',
                'path' => 'storage/images/icons/ternera-2.png',
            ],
            [
                'name' => 'Cerdo 1',
                'path' => 'storage/images/icons/cerdo-1.png',
            ],
            [
                'name' => 'Cerdo 2',
                'path' => 'storage/images/icons/cerdo-2.png',
            ],
            [
                'name' => 'Pescado 1',
                'path' => 'storage/images/icons/pescado-1.png',
            ],
            [
                'name' => 'Pescado 2',
                'path' => 'storage/images/icons/pescado-2.png',
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
            [
                'name' => 'Huevo 1',
                'path' => 'storage/images/icons/huevo-1.png',
            ],
            [
                'name' => 'Huevo 2',
                'path' => 'storage/images/icons/huevo-2.png',
            ],
            [
                'name' => 'Ensalada 1',
                'path' => 'storage/images/icons/ensalada-1.png',
            ],
            [
                'name' => 'Ensalada 2',
                'path' => 'storage/images/icons/ensalada-2.png',
            ],
            [
                'name' => 'Sopa 1',
                'path' => 'storage/images/icons/sopa-1.png',
            ],
            [
                'name' => 'Sopa 2',
                'path' => 'storage/images/icons/sopa-2.png',
            ],
            [
                'name' => 'Pan 1',
                'path' => 'storage/images/icons/pan-1.png',
            ],
            [
                'name' => 'Pan 2',
                'path' => 'storage/images/icons/pan-2.png',
            ],
            [
                'name' => 'Bollería 1',
                'path' => 'storage/images/icons/bolleria-1.png',
            ],
            [
                'name' => 'Bollería 2',
                'path' => 'storage/images/icons/bolleria-2.png',
            ],
            [
                'name' => 'Legumbres',
                'path' => 'storage/images/icons/legumbres.png',
            ],
            [
                'name' => 'Guisantes',
                'path' => 'storage/images/icons/guisantes.png',
            ],
        ] );
    }
}
