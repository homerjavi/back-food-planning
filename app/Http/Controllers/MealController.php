<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealRequest;
use App\Http\Resources\MealCategoryResource;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Meal::class, 'meal', [ 'except' => ['index', 'store'] ]);
    }

    public function index()
    {
        $meals = Meal::fromAuthenticatedUser()->with('category')->orderBy( 'name' )->get();
        return response()->json( MealCategoryResource::collection($meals) );
    }

    public function store( MealRequest $request )
    {
        $meal = Meal::create( $request->input() );
        return response()->json( new MealCategoryResource( $meal ) );
    }

    public function update( MealRequest $request, Meal $meal )
    {
        $meal->update( $request->input() );
        return response()->json( new MealCategoryResource( $meal ) );
    }

    public function destroy( Meal $meal )
    {
        $meal->delete();
        return response()->json( MealCategoryResource::collection( Meal::fromAuthenticatedUser()->orderBy('name')->get() ) );        
    }
}
