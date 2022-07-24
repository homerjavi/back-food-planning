<?php

namespace App\Http\Requests;

use App\Rules\ModelBelongsToAccount;
use Illuminate\Foundation\Http\FormRequest;

class PlanningUpdateMealTypeRequest extends FormRequest
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
        return [
            'id'      =>  [ 'required', new ModelBelongsToAccount( getModel( 'Planning' ) ) ],
            'meal_type_id' =>  [ new ModelBelongsToAccount( getModel( 'MealType' ) ) ],
        ];
    }
}
