<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealCategoryResource;
use App\Http\Resources\MealResource;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
 
    public function index()
    {
        $meals = Meal::with('category')->get();

        return response()->json( MealCategoryResource::collection($meals) );
        
    }

    public function store( Request $request )
    {
        $meal = new Meal();
        $meal->name        = $request->name;
        $meal->description = $request->description;
        $meal->category_id = $request->category[ 'id' ];
        $meal->difficulty  = $request->difficulty;
        $meal->minutes     = $request->minutes;
        $meal->kalories    = $request->kalories;
        $meal->recipe      = $request->recipe;
        $meal->save();

        return response()->json( new MealCategoryResource( $meal ) );
    }

    public function update( Request $request, Meal $meal )
    {
        $meal->name        = $meal[ 'name' ];
        $meal->description = $meal[ 'description' ];
        $meal->category_id = $meal[ 'category' ][ 'id' ];
        $meal->difficulty  = $meal[ 'difficulty' ];
        $meal->minutes     = $meal[ 'minutes' ];
        $meal->kalories    = $meal[ 'kalories' ];
        $meal->recipe      = $meal[ 'recipe' ];
     
        if( $meal->isDirty() ){
            $meal->save();
        }

        return response()->json( new MealCategoryResource( $meal ) );
    }

    public function destroy( $meal )
    {
        $meal = Meal::find($meal);
        $meal->delete();

        return response()->json( MealCategoryResource::collection( Meal::get() ) );        
    }
}
