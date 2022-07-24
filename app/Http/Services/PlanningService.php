<?php 

namespace App\Http\Services;

use App\Http\Resources\PlanningResource;
use App\Models\MealHour;
use App\Models\MealType;
use App\Models\Planning;
use DateTime;

class PlanningService
{
    public function getPlanning( int $weekDiff )
    {
        $day        = ( new DateTime('monday this week') )->modify($weekDiff . ' week');
        $planning   = [];
        $daysOfWeek = [ 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo' ];
        $mealHours  = MealHour::orderBy( 'order' )->get();
        $mealTypes  = MealType::orderBy( 'order' )->get();

        for ($i=1; $i <=7 ; $i++) { 
            $planning[ $i ][ 'name' ] = $daysOfWeek [ $i-1 ];
            $planning[ $i ][ 'date' ] = $day->format('Y-m-d');;

            $planning[ $i ][ 'hours' ] = [];
            foreach ( $mealHours as $mealHour ) {
                $mealHourData          = [];
                $mealHourData['id']    = $mealHour->id;
                $mealHourData['name']  = $mealHour->name;
                $mealHourData['meals'] = PlanningResource::collection( Planning::where('date', $day)->where( 'meal_hour_id', $mealHour->id )->orderBy( 'order' )->get() );;
                array_push( $planning[ $i ][ 'hours' ], $mealHourData );
            }

            $day = $day->modify('+1 day');
        }
        
        return $planning;
    }

}
