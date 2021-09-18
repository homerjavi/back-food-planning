<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryMealResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('meals')->get();

        /* return view('categories.list', [
            'categories' => CategoryMealResource::collection( $categories ),
        ]); */

        $data = [
            // 'categories' => $categories,
            'categories' => CategoryMealResource::collection( $categories ),
        ];

        return response()->json( $data );
    }

    public function store( Request $request )
    {
        
        $category                 = new Category();
        $category->name           = $request->name;
        $category->optimum_number = $request->optimum_number;
        $category->save();

        return response()->json( [
            'status'   => true,
            'category' => $category
        ] );
    }

    public function update( Request $request, $category )
    {
        $category = category::find($category);
        $categoryData = (object) $request->item;

        $category->name           = $categoryData->name;
        $category->optimum_number = $categoryData->optimum_number;
     
        if( $category->isDirty() ){
            $category->save();
        }

        return json_encode(['status' => true]);
    }

    public function destroy( $category )
    {
        $category = Category::find($category);
        $category->delete();

        return json_encode(['status' => true]);        
    }
}
