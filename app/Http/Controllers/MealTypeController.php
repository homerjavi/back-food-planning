<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealTypeStoreRequest;
use App\Http\Requests\MealTypeUpdateRequest;
use App\Http\Resources\MealTypeResource;
use App\Models\MealType;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    public function index()
    {
        return response()->json( MealTypeResource::collection( MealType::orderBy( 'order' )->get() ) );
    }

    public function store(MealTypeStoreRequest $request)
    {
        $mealType = new MealType();

        $mealType->name  = $request[ 'name' ];
        $mealType->color = $request[ 'color' ];
        $mealType->order = $request[ 'order' ] ?? MealType::max( 'order' ) + 1;

        MealType::updateOrders();

        $mealType->save();

        return response()->json( MealTypeResource::collection( MealType::orderBy( 'order' )->get() ) );
    }

    public function update(MealTypeUpdateRequest $request, MealType $mealType)
    {
        $mealType->name  = $request[ 'name' ];
        $mealType->color = $request[ 'color' ];
        $mealType->order = $request[ 'order' ] ?? MealType::max( 'order' ) + 1;

        if ( $mealType->isDirty() ) {
            $mealType->save();
        }

        MealType::updateOrders();

        return response()->json( MealTypeResource::collection( MealType::orderBy( 'order' )->get() ) );
    }

    public function destroy($id)
    {
        MealType::destroy($id);

        MealType::updateOrders();

        return response()->json( MealTypeResource::collection( MealType::orderBy( 'order' )->get() ) );
    }
}
