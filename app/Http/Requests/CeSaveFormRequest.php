<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CeSaveFormRequest extends Request
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

        foreach($this->request->get('ce') as $key => $val)
        {
            $rules['ce.'.$key] = 'date_multi_format:"i:s.u"|required_with:penalty_ce.'.$key.'';
        }

        foreach($this->request->get('penalty_ce') as $key => $val)
        {
            $rules['penalty_ce.'.$key] = 'integer|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach($this->request->get('ce') as $key => $val)
        {
            $messages['ce.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben az időeredmény megadása nem a következő formátumban történt vagy a beírt érték nem valós: pp:mm.ss - pl.: 13:20.00';
            $messages['ce.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben az időeredmény megadása kötelező.';
        }

        foreach($this->request->get('penalty_ce') as $key => $val)
        {
            $messages['penalty_ce.'.$key.'.integer'] = 'A pirossal jelölt mezőkben egész számot kell megadni.';
            $messages['penalty_ce.'.$key.'.min'] = 'A pirossal jelölt mezőkben megadott szám értékének minimum 0-nak kell lennie.';
        }

        return $messages;
    }
}
