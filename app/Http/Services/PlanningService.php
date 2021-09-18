<?php 

namespace App\Http\Services;

use App\Http\Resources\PlanningResource;
use App\Models\Planning;
use DateTime;

class PlanningService
{
    public function getPlanning()
    {
        $day        = new DateTime('monday this week');
        $planning   = [];
        $daysOfWeek = [ 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo' ];

        for ($i=1; $i <=7 ; $i++) { 
            $planning[ $i ][ 'name' ]   = $daysOfWeek [ $i-1 ];
            $planning[ $i ][ 'lunch' ]  = PlanningResource::collection( Planning::where('date', $day)->where( 'hour', 'lunch' )->orderBy( 'type' )->orderBy( 'order' )->get() );
            $planning[ $i ][ 'dinner' ] = PlanningResource::collection( Planning::where('date', $day)->where( 'hour', 'dinner' )->orderBy( 'type' )->orderBy( 'order' )->get() );
            $day = $day->modify('+1 day');
        }
        
        return $planning;
    }

}
