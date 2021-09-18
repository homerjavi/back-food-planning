<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    public function updateOrderSameType()
    {
        $planningsToUpdateOrder = $this->sameType()
                                       ->equalOrHigherOrder($this->order)
                                       ->orderBy('order')
                                       ->get();

        foreach ($planningsToUpdateOrder as $planning) {
            $planning->order = $planning->order+1;
            $planning->save();
        }
    }

    public function scopeSameType(Builder $query)
    {
        return $query->where('date', $this->date)
                     ->where('hour', $this->hour)
                     ->where('type', $this->type);
    }

    public function scopeEqualOrHigherOrder(Builder $query, $order)
    {
        return $query->where('order', '>=', $order);
    }


}
