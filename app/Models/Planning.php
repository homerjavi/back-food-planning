<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [ 'meal_type_id' ];

    public function mealType()
    {
        return $this->belongsTo(MealType::class);
    }

    public function updateOrderSameType( $isDeleted = null )
    {
        $planningsToUpdateOrder = $this->sameType()
                                       ->equalOrHigherOrder($this->order)
                                       ->orderBy('order')
                                       ->orderBy('updated_at', 'DESC')
                                    //    ->orderBy('created_at', 'ASC')
                                       ->get();
                                       

        $firstOrder = count($planningsToUpdateOrder) > 0 ? $planningsToUpdateOrder->first()->order + 1 : 0;

        //dump( $planningsToUpdateOrder, $firstOrder );

        foreach ($planningsToUpdateOrder as $index => $planning) {
            // $p = Planning::find( $planning->id );
            $planning->order = $isDeleted ? $planning->order - 1 : $firstOrder++;
            
            $planning->save();
        }
    }

    public function scopeSameType(Builder $query)
    {
        return $query->where('date', $this->date)
                     ->where('meal_hour_id', $this->meal_hour_id)
                     ->where('meal_type_id', $this->meal_type_id);
    }

    public function scopeEqualOrHigherOrder(Builder $query, $order)
    {
        return $query->where('order', '>=', $order)
                     ->where('id', '!=', $this->id);
    }


}
