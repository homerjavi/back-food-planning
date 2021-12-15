<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealTypeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'color' => 'max:7'
        ];
    }
}
