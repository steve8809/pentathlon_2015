<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FencingSaveFormRequest extends Request
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
        $rules = [];

        foreach($this->request->get('penalty_fencing') as $key => $val)
        {
            $rules['penalty_fencing.'.$key] = 'integer|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach($this->request->get('penalty_fencing') as $key => $val)
        {
            $messages['penalty_fencing.'.$key.'.integer'] = 'A pirossal jelölt mezőben egész számot kell megadni.';
            $messages['penalty_fencing.'.$key.'.min'] = 'A pirossal jelölt mezőben megadott szám értékének minimum 0-nak kell lennie.';
        }

        return $messages;
    }
}
