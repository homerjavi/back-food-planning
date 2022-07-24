<?php

namespace App\Http\Requests;

use App\Models\Meal;
use App\Rules\ModelBelongsToAccount;
use Illuminate\Foundation\Http\FormRequest;

class PlanningStoreRequest extends FormRequest
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
        switch ( $this->method() ) {
            case 'POST':
                return [
                    'meal_id'      =>  [ 'required', new ModelBelongsToAccount( getModel( 'Meal' ) ) ],
                    'meal_hour_id' =>  [ 'required', new ModelBelongsToAccount( getModel( 'MealHour' ) ) ],
                    'meal_type_id' =>  [ 'nullable', new ModelBelongsToAccount( getModel( 'MealType' ) ) ],
                    'date'         =>  [ 'date_format:Y-m-d' ],
                    'day_of_week'  =>  [ 'integer', 'min:1', 'max:7' ],
                    'order'        =>  [ 'integer', 'min:1' ],
                ];
                break;
            
            default:
                return [
                
                ];       
                break;
        }
    }
}
