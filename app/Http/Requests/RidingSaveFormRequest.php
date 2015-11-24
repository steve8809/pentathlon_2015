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
            $rules['riding.'.$key] = 'integer|between:0,250';
        }

        foreach($this->request->get('horse_id') as $key => $val)
        {
            $rules['horse_id.'.$key] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('riding') as $key => $val)
        {
            $messages['riding.'.$key.'.integer'] = 'A pirossal jelölt mezőkben a pontszám megadása nem megfelelő.';
            $messages['riding.'.$key.'.between'] = 'A pirossal jelölt mezőkben nem megfelelő a pontszám: 0 és 250 közötti értéket kell megadni.';
        }

        foreach($this->request->get('horse_id') as $key => $val)
        {
            $messages['horse_id.'.$key.'.required'] = 'A pirossal jelölt mezőkben a ló kiválasztása kötelező.';
        }

        return $messages;
    }
}
