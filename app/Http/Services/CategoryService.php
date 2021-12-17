<?php 

namespace App\Http\Services;

use App\Http\Resources\PlanningResource;
use App\Models\Category;
use App\Models\Icon;
use App\Models\MealHour;
use App\Models\MealType;
use App\Models\Planning;
use DateTime;

class CategoryService
{
    public function save( $request, $category = null )
    {
        if ( !$category ) {
            $category = new Category();
        }

        $category->name           = $request->name;
        $category->icon_id        = $request->has('icon') && $request->icon ? $request->icon[ 'id' ] : Icon::first()->id;
        $category->optimum_number = $request->optimum_number ?? 0;
        $category->save();

        return $category;
    }
}
