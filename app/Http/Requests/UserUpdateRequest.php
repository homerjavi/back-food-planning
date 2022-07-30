<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'id'           => 'required',
            'name'         => 'required|min:1|max:255',
            'email'        => 'required|string|email|unique:users,email,'.request()->id,
            'account_id'   => 'required',
            'account_name' => 'required|string|min:4|max:255|unique:accounts,name,'.request()->account_id,
            'password'     => 'string|min:3|max:12',
            'repassword'   => 'required_with:password|string|min:3|max:12|same:password',
        ];
    }
}
