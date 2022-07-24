<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanningStoreRequest;
use App\Http\Requests\PlanningUpdateMealTypeRequest;
use App\Http\Requests\PlanningUpdateOrderRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PlanningResource;
use App\Http\Services\PlanningService;
use App\Models\Category;
use App\Models\Meal;
use App\Models\MealHour;
use App\Models\MealType;
use App\Models\Planning;
use DateTime;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Planning::class, 'Planning', [ 'except' => ['index', 'store', 'destroy'] ]);
    }

    public function index( Request $request, PlanningService $planningService )
    {
        $meals      = Meal::fromAuthenticatedUser()->with('category')->get();
        $categories = Category::fromAuthenticatedUser()->with( 'meals' )->orderBy( 'name' )->get();
        $mealTypes  = MealType::fromAuthenticatedUser()->orderBy( 'order' )->get();
        $mealHours  = MealHour::fromAuthenticatedUser()->orderBy( 'order' )->get();
  
        $data = [
            'planning'   => $planningService->getPlanning( $request->weekDiff ?? 0 ),
            'categories' => CategoryResource::collection( $categories ),
            'meals'      => $meals,
            'mealTypes'  => $mealTypes,
            'mealHours'  => $mealHours,
        ];

        return response()->json( $data );
    }

    public function store( PlanningStoreRequest $request )
    {
        $planning = Planning::create( $request->input() );
        
        $planning->updateOrderSameType( $planning );

        $planningTarget = Planning::fromAuthenticatedUser()->where('date', $planning->date)
            ->where('meal_hour_id', $planning->meal_hour_id)
            ->orderBy('order')
            ->get();
    
            return response()->json( PlanningResource::collection( $planningTarget ) );
    }

    public function updateOrderPlanning( PlanningUpdateOrderRequest $request )
    {
        $planning = Planning::find( $request->id );
        $planning->order         = $request->order;
        $planning->save();
        $planning->updateOrderSameType( $planning );

        $planningTarget = Planning::fromAuthenticatedUser()->where('date', $planning->date)
                        ->where('meal_hour_id', $planning->meal_hour_id)
                        ->orderBy('order')
                        ->get();

        return response()->json( PlanningResource::collection( $planningTarget ) );
    }

    public function updateMealType( PlanningUpdateMealTypeRequest $request )
    {
        Planning::find( $request->id )->update( [ 
            'meal_type_id' => $request->meal_type_id
         ] );

        return Planning::find( $request->id );
    }

    public function destroy( Planning $planning )
    {        
        $isDestroy = $planning->delete();

        if( $isDestroy ){
            $planning->updateOrderSameType( $planning );
            $planningTarget = Planning::fromAuthenticatedUser()->where('date', $planning->date)
                ->where('meal_hour_id', $planning->meal_hour_id)
                ->orderBy('order')
                ->get();
    
            return response()->json( PlanningResource::collection( $planningTarget ) );
        }
        else{
            return 'KO';
        }
    }
}
