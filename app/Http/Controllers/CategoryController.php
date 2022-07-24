<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
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
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category', [ 'except' => ['index', 'store'] ]);
    }

    public function index( Request $request )
    {
        $categories = Category::fromAuthenticatedUser()
                        ->with( [ 'meals' => function( $query ) {
                            $query->orderBy( 'name' );
                        } ] )        
                        ->orderBy( 'name' )->get();
        
        $data = [
            'categories' => CategoryMealResource::collection( $categories ),
            'icons'      => IconResource::collection( Icon::orderBy( 'name' )->get() ),
        ];

        return response()->json( $data );
    }

    public function store( CategoryRequest $request )
    {
        $category = Category::create( $request->input() );
        return response()->json( new CategoryResource( $category ) );
    }

    public function update( CategoryRequest $request, Category $category )
    {
        $category->update( $request->input() );
        return response()->json( new CategoryResource( $category ) );
    }

    public function destroy( Category $category )
    {    
        $category->delete();
        return response()->json( CategoryResource::collection( Category::fromAuthenticatedUser()->orderBy('name')->get() ) );
    }
}
