<?php

namespace App\Http\Requests;

use App\Models\MealHour;
use Illuminate\Foundation\Http\FormRequest;

class MealHourStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $maxOrderAllowed = MealHour::fromAuthenticatedUser()->count() + 1;
        
        return [
            'name'    => 'required|max:255|unique:meal_hours,name',
            'order'   => ['nullable', 'numeric', 'min:1', 'max:' . $maxOrderAllowed]
        ];
    }
}
