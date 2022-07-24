<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealHour extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public static function updateOrders( MealHour $mealHour, string $method = '' )
    {
        $mealHoursToOrder = MealHour::fromAuthenticatedUser()
            ->where( 'id', '!=', $mealHour->id )
            ->orderBy( 'order' )
            ->get();

        $newOrder = 1;
        foreach ( $mealHoursToOrder as $mealHourToOrder ) {
            if ( $newOrder == $mealHour->order && $method != 'delete' ){
                $newOrder++;    
            }
            
            $mealHourToOrder->order = $newOrder;
            $mealHourToOrder->save();
            $newOrder++;
        }
    }

    public function scopeFromAuthenticatedUser( Builder $builder )
    {
        return $builder->whereAccountId( auth()->user()->account_id );
    }

    protected static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->created_by = auth()->user()->id;
                $model->account_id = auth()->user()->account_id;
                $model->order      = request()->order ?? MealHour::fromAuthenticatedUser()->count() + 1;
            }
        });

        self::updating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->updated_by = auth()->user()->id;
                if( !request()->order && $model->id == request()->id ){
                    $model->order = MealHour::fromAuthenticatedUser()->count();
                }
            }
        });
    }
}
