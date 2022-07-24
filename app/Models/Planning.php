<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Planning extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function mealType()
    {
        return $this->belongsTo(MealType::class);
    }

    /* public function updateOrderSameType( bool $isDeleted = null )
    {
        $planningsToUpdateOrder = $this::fromAuthenticatedUser()->sameType()
                                       ->orderBy('order')
                                       ->orderBy('updated_at', 'DESC');

        if ( $isDeleted ) {
            $planningsToUpdateOrder->where( 'id', '!=', $this->id );
        }

        $order = 1;
        foreach ($planningsToUpdateOrder->get() as $planning) {
            $planning->order = $order++;
            $planning->save();
        }
    } */

    public static function updateOrderSameType( Planning $planning, string $method = '' )
    {
        $planningsToUpdateOrder = Planning::fromAuthenticatedUser()
            ->where( 'id', '!=', $planning->id )
            ->sameType( $planning )
            ->orderBy('order')
            ->get();

        /* if ( $method == 'store' ){
            $planningsToUpdateOrder = $planningsToUpdateOrder->orderBy( 'created_at', 'DESC' )
                        ->get();
        } else if ( $method == 'update' ){
            $planningsToUpdateOrder = $planningsToUpdateOrder->orderBy( 'updated_at', 'DESC' )
                        ->get();
        } else{
            $planningsToUpdateOrder = $planningsToUpdateOrder->get();
        } */

        $newOrder = 1;
        // $maxOrder = 0;
        foreach ( $planningsToUpdateOrder as $planningToUpdateOrder ) {
            if ( $newOrder == $planning->order && $method != 'delete' ){
                $newOrder++;    
            }
            
            $planningToUpdateOrder->order = $newOrder;
            $planningToUpdateOrder->save();
            $newOrder++;
        }
    }

    public function scopeSameType(Builder $query, Planning $planning)
    {
        return $query->where('date', $planning->date)
                     ->where('meal_hour_id', $planning->meal_hour_id);
    }

    public function scopeEqualOrHigherOrder(Builder $query, $order)
    {
        return $query->where('order', '>=', $order)
                     ->where('id', '!=', $this->id);
    }

    public function scopeFromAuthenticatedUser( Builder $builder )
    {
        return $builder->whereAccountId( auth()->user()->account_id );
    }

    protected static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->created_by   = auth()->user()->id;
                $model->account_id   = auth()->user()->account_id;
                $model->meal_type_id = request()->meal_type_id ?? MealType::fromAuthenticatedUser()->orderBy('order')->first();
                $model->order        = request()->order ?? Planning::fromAuthenticatedUser()->where('date', request()->date)
                    ->where('meal_hour_id', request()->meal_hour_id)
                    ->count() + 1;
            }
        });

        self::updating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }

}
