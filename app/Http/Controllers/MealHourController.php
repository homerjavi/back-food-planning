<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealHourStoreRequest;
use App\Http\Requests\MealHourUpdateRequest;
use App\Http\Resources\MealHourResource;
use App\Models\MealHour;
use Illuminate\Http\Request;

class MealHourController extends Controller
{
    
    public function index()
    {
        return response()->json( MealHourResource::collection( MealHour::orderBy( 'order' )->get() ) );
    }

    public function store(MealHourStoreRequest $request)
    {
        $mealHour = new MealHour();
        $mealHour->name  = $request[ 'name' ];
        $mealHour->order = $request[ 'order' ] ?? MealHour::max( 'order' ) + 1;
        $mealHour->save();

        MealHour::updateOrders();

        return response()->json( MealHourResource::collection( MealHour::orderBy( 'order' )->get() ) );
    }

    public function update(MealHourUpdateRequest $request, MealHour $mealHour)
    {
        $mealHour->name  = $request[ 'name' ];
        $mealHour->order = $request[ 'order' ] ?? MealHour::max( 'order' ) + 1;

        if ( $mealHour->isDirty() ) {
            $mealHour->save();
        }

        MealHour::updateOrders();

        return response()->json( MealHourResource::collection( MealHour::orderBy( 'order' )->get() ) );
    }

    public function destroy($id)
    {
        MealHour::destroy($id);

        MealHour::updateOrders();

        return response()->json( MealHourResource::collection( MealHour::orderBy( 'order' )->get() ) );
    }
}
