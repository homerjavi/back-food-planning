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
        /* $categories = Category::all();

        return view('meals.list', [
            'meals'      => $meals,
            'categories' => $categories,
        ]); */
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

        return response()->json( [
            'status' => true,
            'meal'   => $meal
        ] );
    }

    public function update( Request $request, $meal )
    {
        $meal = Meal::find($meal);
        $mealData = (object) $request->item;

        $meal->name        = $mealData->name;
        $meal->description = $mealData->description;
        $meal->category_id = $mealData->category[ 'id' ];
        $meal->difficulty  = $mealData->difficulty;
        $meal->minutes     = $mealData->minutes;
        $meal->kalories    = $mealData->kalories;
        $meal->recipe      = $mealData->recipe;
     
        if( $meal->isDirty() ){
            $meal->save();
        }

        return json_encode(['status' => true]);
    }

    public function destroy( $meal )
    {
        $meal = Meal::find($meal);
        $meal->delete();

        return json_encode(['status' => true]);        
    }
}
