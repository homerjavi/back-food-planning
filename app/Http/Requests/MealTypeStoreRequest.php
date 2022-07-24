<?php

namespace App\Http\Requests;

use App\Models\MealType;
use Illuminate\Foundation\Http\FormRequest;

class MealTypeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $maxOrderAllowed = MealType::fromAuthenticatedUser()->count() + 1;

        return [
            'name'    => 'required|max:255|unique:meal_types,name',
            'general' => 'nullable|boolean',
            'color'   => 'nullable|max:7',
            'order'   => ['nullable', 'numeric', 'min:1', 'max:' . $maxOrderAllowed]
        ];
    }
}
