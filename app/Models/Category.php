<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function meals()
    {
        return $this->hasMany( Meal::class );
    }

    public function icon()
    {
        return $this->belongsTo( Icon::class );
    }

    public function scopeFromAuthenticatedUser( Builder $builder )
    {
        return $builder->whereAccountId( auth()->user()->account_id );
    }

    public function belongsToAccountAuthUser () :bool
    {
        return $this->account_id == auth()->user()->account_id;
    }

    protected static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->created_by = auth()->user()->id;
                $model->account_id = auth()->user()->account_id;
                if ( !request()->has( 'icon_id' ) ) {
                    $model->icon_id = Icon::first()->id;
                }
                if ( !request()->has( 'optimum_number' ) ) {
                    $model->optimum_number = 0;
                }
            }
        });

        self::updating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->updated_by = auth()->user()->id;
            }
        });

        self::deleting(function ($model) {
            if (!app()->runningInConsole()) {
                $mealIds = $model->meals->pluck('id')->toArray();
                Meal::destroy( $mealIds );
            }
        });
    }
}
