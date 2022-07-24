<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFromAuthenticatedUser( Builder $builder )
    {
        return $builder->whereIn('category_id', Category::fromAuthenticatedUser()->get('id')->pluck('id')->toArray());
    }

    protected static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->created_by = auth()->user()->id;
            }
        });

        self::updating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }
}