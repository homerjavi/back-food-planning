<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public static function updateOrders( MealType $mealType, string $method = '' )
    {
        $mealTypesToOrder = MealType::fromAuthenticatedUser()
            ->where( 'id', '!=', $mealType->id )
            ->orderBy( 'order' )
            ->get();

        $newOrder = 1;
        foreach ( $mealTypesToOrder as $mealTypeToOrder ) {
            if ( $newOrder == $mealType->order && $method != 'delete' ){
                $newOrder++;    
            }
            
            $mealTypeToOrder->order = $newOrder;
            $mealTypeToOrder->save();
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
                $model->general    = request()->has( 'general' );
                $model->color      = request()->color ?? '#ffffff';
                $model->order      = request()->order ?? MealType::fromAuthenticatedUser()->count() + 1;
            }
        });

        self::updating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->updated_by = auth()->user()->id;
                if( $model->id == request()->id ){
                    if ( !request()->has( 'general' ) ) {
                        $model->general = false ;
                    }
                    if ( !request()->color ) {
                        $model->color = '#ffffff';
                    }
                    if ( !request()->order ) {
                        $model->order = MealType::fromAuthenticatedUser()->count();
                    }
                }
            }
        });
    }
}
