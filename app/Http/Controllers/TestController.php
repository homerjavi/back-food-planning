<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanningResource;
use App\Http\Services\PlanningService;
use App\Models\MealType;
use App\Models\Planning;
use DateTime;

class TestController extends Controller
{
    public function test()
    {
        $mondayThisWeek  = new DateTime('monday this week');
        $date            = date('Y-m-d', strtotime($mondayThisWeek->format( 'Y-m-d' ) . ' +' . ( 2-1 ) . 'days' ) );

        $planning               = new Planning();
        $planning->meal_id      = 3;
        $planning->date         = $date;
        $planning->day_of_week  = 2;
        $planning->meal_hour_id = 2;
        $planning->meal_type_id = MealType::first()->id;
        $planning->order        = 2;
        $planning->save();
        
        $planning->updateOrderSameType( false );

        $planningTarget = Planning::where('date', $planning->date)
            ->where('meal_hour_id', $planning->meal_hour_id)
            ->where('meal_type_id', $planning->meal_type_id)
            ->orderBy('order')
            ->get();

        dump( $planningTarget, PlanningResource::collection( $planningTarget )->resolve() );
    
            return response()->json( PlanningResource::collection( $planningTarget ) );
    }
}
