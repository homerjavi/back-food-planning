<?php

namespace App\Http\Requests;

use App\Models\MealType;
use Illuminate\Foundation\Http\FormRequest;

class MealTypeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $maxOrderAllowed = MealType::fromAuthenticatedUser()->count();
        
        return [
            'name'    => 'required|max:255|unique:meal_types,name,'.$this->route('mealType')->id,
            'general' => 'nullable|boolean',
            'color'   => 'nullable|max:7',
            'order'   => ['nullable', 'numeric', 'min:1', 'max:' . $maxOrderAllowed]
        ];
    }
}
