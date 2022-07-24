<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanningResource;
use App\Http\Services\PlanningService;
use App\Models\MealType;
use App\Models\Planning;
use DateTime;

class TestController extends Controller
{
    public function test()
    {
        $model = "App\Models\Meal";

        return response()->json( app($model)->all() );
    }
}
