<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealHourStoreRequest;
use App\Http\Requests\MealHourUpdateRequest;
use App\Http\Resources\MealHourResource;
use App\Models\MealHour;

class MealHourController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MealHour::class, 'mealHour', [ 'except' => ['index', 'store'] ]);
    }
    
    public function index()
    {
        return response()->json( MealHourResource::collection( MealHour::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function store(MealHourStoreRequest $request)
    {
        $mealHour = MealHour::create( $request->input() );
        // $mealHour = new MealHour();
        // $mealHour->name  = $request[ 'name' ];
        // // $mealHour->order = $request[ 'order' ] ?? MealHour::fromAuthenticatedUser()->max( 'order' ) + 1;
        // $mealHour->save();

        MealHour::updateOrders( $mealHour );

        return response()->json( MealHourResource::collection( MealHour::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function update(MealHourUpdateRequest $request, MealHour $mealHour)
    {
        $mealHour->update( $request->input() );
        MealHour::updateOrders( $mealHour );

        return response()->json( MealHourResource::collection( MealHour::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function destroy(MealHour $mealHour)
    {
        $mealHour->delete();

        MealHour::updateOrders( $mealHour, 'delete' );

        return response()->json( MealHourResource::collection( MealHour::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }
}
