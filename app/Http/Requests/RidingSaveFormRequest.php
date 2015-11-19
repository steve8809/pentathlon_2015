<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RidingSaveFormRequest extends Request
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

        foreach($this->request->get('riding') as $key => $val)
        {
            $rules['riding.'.$key] = 'integer|max:250';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('riding') as $key => $val)
        {
            $messages['riding.'.$key.'.integer'] = 'A pirossal jelölt mezőkben a pontszám megadása nem megfelelő.';
            $messages['riding.'.$key.'.max'] = 'A pirossal jelölt mezőkben 250-nél nagyobb a pontszám.';
        }

        return $messages;
    }
}
