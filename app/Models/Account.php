<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    public function users () {
        return $this->hasMany( User::class );
    }

    public function categories () {
        return $this->hasMany( Category::class );
    }

    public function meals () {
        return $this->hasMany( Meal::class );
    }

    public function mealHours () {
        return $this->hasMany( MealHour::class );
    }
    
    public function mealTypes () {
        return $this->hasMany( MealType::class );
    }
}
