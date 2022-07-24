<?php

namespace App\Http\Requests;

use App\Models\MealHour;
use Illuminate\Foundation\Http\FormRequest;

class MealHourUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $maxOrderAllowed = MealHour::fromAuthenticatedUser()->count();

        return [
            'name'  => 'required|max:255|unique:meal_hours,name,'.$this->route( 'mealHour' )->id,
            'order'   => ['nullable', 'numeric', 'min:1', 'max:' . $maxOrderAllowed]
        ];
    }
}
