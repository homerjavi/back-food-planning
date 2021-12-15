<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealHour extends Model
{
    use HasFactory;

    public static function updateOrders( int $firstOrderToUpdate = 1 )
    {
        //$maxOrder =  MealHour::max( 'order' );
        $mealHours = MealHour::where( 'order', '>=', $firstOrderToUpdate )
                            ->orderBy( 'order' )
                            ->orderBy( 'updated_at', 'DESC' )
                            ->get();
        
        //$sumOrder = 0;
        foreach ( $mealHours as $mealHour ) {
            $mealHour->order = $firstOrderToUpdate++;
            $mealHour->save();
        }
    }
}
