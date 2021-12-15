<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;

    public static function updateOrders( int $firstOrderToUpdate = 1 )
    {
        $mealTypes = MealType::where( 'order', '>=', $firstOrderToUpdate )
                            ->orderBy( 'order' )
                            ->orderBy( 'updated_at', 'DESC' )
                            ->get();
        
        //$sumOrder = 0;
        foreach ( $mealTypes as $mealType ) {
            $mealType->order = $firstOrderToUpdate++;
            $mealType->save();
        }
    }
}
