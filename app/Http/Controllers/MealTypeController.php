<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealTypeStoreRequest;
use App\Http\Requests\MealTypeUpdateRequest;
use App\Http\Resources\MealTypeResource;
use App\Models\MealType;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MealType::class, 'mealType', [ 'except' => ['index', 'store'] ]);
    }

    public function index()
    {
        return response()->json( MealTypeResource::collection( MealType::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function store(MealTypeStoreRequest $request)
    {
        // $mealType = new MealType();

        // $mealType->name    = $request[ 'name' ];
        // $mealType->general = $request[ 'general' ] ?? false;
        // $mealType->color   = $request[ 'color' ] ?? '#ffffff';
        // $mealType->order   = $request[ 'order' ] ?? MealType::fromAuthenticatedUser()->max( 'order' ) + 1;

        // $mealType->save();

        // MealType::updateOrders( $mealType->id, 'store' );

        $mealType = MealType::create( $request->input() );
        MealType::updateOrders( $mealType );

        return response()->json( MealTypeResource::collection( MealType::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function update(MealTypeUpdateRequest $request, MealType $mealType)
    {
        $mealType->update( $request->input() );
        MealType::updateOrders( $mealType->id, 'update' );

        return response()->json( MealTypeResource::collection( MealType::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }

    public function destroy( MealType $mealType )
    {
        $mealType->delete();

        MealType::updateOrders( $mealType );

        return response()->json( MealTypeResource::collection( MealType::fromAuthenticatedUser()->orderBy( 'order' )->get() ) );
    }
}
