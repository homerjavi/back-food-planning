<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryMealResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\IconResource;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Models\Icon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('meals')->get();
        
        $data = [
            'categories' => CategoryMealResource::collection( $categories ),
            'icons'      => IconResource::collection( Icon::all() ),
        ];

        return response()->json( $data );
    }

    public function store( CategoryStoreRequest $request, CategoryService $categoryService )
    {
        
        $category = $categoryService->save( $request );

        return response()->json( new CategoryResource( $category ) );
    }

    public function update( Request $request, Category $category, CategoryService $categoryService )
    {
        /* $category->name           = $request[ 'name' ];
        $category->icon_id        = $request[ 'icon' ][ 'id' ];
        $category->optimum_number = $request[ 'optimum_number' ]; */

        $category = $categoryService->save( $request );
     
        if( $category->isDirty() ){
            $category->save();
        }

        return response()->json( new CategoryResource( $category ) );
    }

    public function destroy( $category )
    {
        $category = Category::find($category);
        $category->delete();
    
        return response()->json( CategoryResource::collection( Category::get() ) );
    }
}
