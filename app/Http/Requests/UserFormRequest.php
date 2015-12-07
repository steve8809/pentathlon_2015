<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UserFormRequest extends Request
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
            'name' => 'required|alpha_num|unique:users,name,'.$this->id,
            'email'=> 'required|unique:users,email,'.$this->id,
            'role'=> 'required',
            'password'=>'alpha_num|min:6|confirmed',
            'password_confirmation'=>'alpha_num|min:6',
        ];
    }
}
