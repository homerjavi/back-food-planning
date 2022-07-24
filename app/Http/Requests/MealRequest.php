<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\ModelBelongsToAccount;
use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $specificRules = []; 
        switch ( $this->method() ) {
            case 'POST':
                    $specificRules['name'] = 'required|string|max:255|unique:meals,name';
                break;

            case 'PATCH':
                    $specificRules['name'] = 'required|string|max:255|unique:meals,name,'.$this->route("meal")->id;
                break;
            
            default:
                return [];        
                break;
        }

        $commonRules = [
            'description' => 'nullable|string|max:255',
            'category_id' => ['required', new ModelBelongsToAccount( Category::class ) ],
            'difficulty'  => 'nullable|numeric|between:0,5',
            'minutes'     => 'nullable|numeric',
            'kalories'    => 'nullable|numeric',
            'recipe'      => 'nullable|string|max:255',
            'favorite'    => 'boolean',
        ];

        return array_merge( $specificRules, $commonRules );
    }
}
