<?php

namespace App\Http\Requests;

use App\Rules\ModelBelongsToAccountUser;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case "POST": {
                return [
                    'name'           => 'required|max:255|unique:categories',
                    'icon_id'        => 'exists:icons,id',
                    'optimum_number' => 'integer|min:0'
                ];
            }
            case "PATCH": {
                return [
                    'name'           => 'required|max:255|unique:categories,name,'.$this->route("category")->id,
                    'icon_id'        => 'exists:icons,id',
                    'optimum_number' => 'integer|min:0'
                ];
            }
            default: {
                return [];
            }
        }
    }
}
