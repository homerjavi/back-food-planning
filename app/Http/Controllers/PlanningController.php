<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanningResource;
use App\Http\Services\PlanningService;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Planning;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index( PlanningService $planningService )
    {
        $meals      = Meal::with('category')->get();
        $categories = Category::with('meals')->get();
  
        $data = [
            'planning'   => $planningService->getPlanning(),
            'categories' => $categories,
            'meals'      => $meals,
        ];

        return response()->json( $data );
    }

    public function store( Request $request )
    {
        $mondayThisWeek  = new DateTime('monday this week');
        $date            = date('Y-m-d', strtotime($mondayThisWeek->format( 'Y-m-d' ) . ' +' . ( $request->day_of_week-1 ) . 'days' ) );

        $planning              = new Planning();
        $planning->meal_id     = $request->meal_id;
        $planning->date        = $date;
        $planning->day_of_week = $request->day_of_week;
        $planning->hour        = $request->hour;
        $planning->type        = 'Lucas';
        $planning->order       = $request->order;
        $planning->updateOrderSameType();
        $planning->save();

        $data = [
            'planning' => $planning,
        ];

        /* $planningsOfDayHour = Planning::where( 'date', $date )
                                      ->where( 'hour', $request->newMeal[ 'hour' ] )
                                      ->where( 'type', $request->newMeal[ 'type' ] )
                                      ->orderBy( 'order' )->get(); */

        /* $data = [
            'day_of_week' => $request->newMeal[ 'day_of_week' ],
            'hour'        => $request->newMeal[ 'hour' ],
            'planning'    => PlanningResource::collection( $planningsOfDayHour )
        ]; */

        return response()->json( $data );
        
    }

    public function update( Request $request, Planning $planning )
    {
        //dd( $request->all(), $planning );

        $monday        = new DateTime('monday this week');
        $dayOfWeekTo   = $request->to[ 'day' ];
        $dateTo        = date( 'Y-m-d', strtotime( $monday->format( 'Y-m-d' ) . ' +' . ( $dayOfWeekTo - 1 ) . 'days' ) );
        $dayOfWeekFrom = $request->to[ 'day' ];
        $dateFrom      = date( 'Y-m-d', strtotime( $monday->format( 'Y-m-d' ) . ' +' . ( $dayOfWeekFrom - 1 ) . 'days' ) );


        $planning->date        = $dateTo;
        $planning->day_of_week = $dayOfWeekTo;
        $planning->hour        = $request->to[ 'hour' ];
        $planning->type        = $request->to[ 'type' ];
        $planning->save();

        foreach ( $request->to[ 'plannings' ] as $key => $planning ) {
            $planning = Planning::find( $planning[ 'id' ] );
            $planning->order = $key + 1;
            $planning->save();
        }

        $planningsTo = Planning::where( 'date', $dateTo )
                                ->where( 'hour', $request->to[ 'hour' ] )
                                ->where( 'type', $request->to[ 'type' ] )
                                ->orderBy( 'order' )->get();

        $planningsFrom = new Collection();   

        if( $request->to[ 'day' ]  != $request->from[ 'day' ]  ||
            $request->to[ 'hour' ] != $request->from[ 'hour' ] ||
            $request->to[ 'type' ] != $request->from[ 'type' ] ){
                
            $planningsFrom = Planning::where( 'date', $dateFrom )
                                     ->where( 'hour', $request->from[ 'hour' ] )
                                     ->where( 'type', $request->from[ 'type' ] )
                                     ->orderBy( 'order' )->get();
        }

        $data = [
            'day_of_week_to'   => $dayOfWeekTo,
            'hour_to'          => $request->to[ 'hour' ],
            'type_to'          => $request->to[ 'type' ],
            'planning_to'      => PlanningResource::collection( $planningsTo ),
            'day_of_week_from' => $dayOfWeekFrom,
            'hour_from'        => $request->to[ 'hour' ],
            'type_from'        => $request->from[ 'type' ],
            'planning_from'    => PlanningResource::collection( $planningsFrom )
        ];

        return response( $data , 200 );
    }

    public function destroy( Planning $planning )
    {
        $isDestroy = $planning->delete();

        $plannings = Planning::where( 'date', $planning->date )
                            ->where( 'hour', $planning->hour )
                            ->where( 'type', $planning->type )
                            ->orderBy( 'order' )->get();

        foreach ( $plannings as $key => $planning ) {
            $planning->order = $key + 1;
            $planning->save();
        }

        if( $isDestroy ){
            return PlanningResource::collection( $plannings );
        }
        else{
            return 'KO';
        }
        
    }
    
    public function deleteAll( PlanningService $planningService )
    {
        Planning::truncate();

        $meals      = Meal::with('category')->get();
        $categories = Category::with('meals')->get();
  
        $data = [
            'planning'   => $planningService->getPlanning(),
            'categories' => $categories,
            'meals'      => $meals,
        ];

        return response()->json( $data );
    }
}
