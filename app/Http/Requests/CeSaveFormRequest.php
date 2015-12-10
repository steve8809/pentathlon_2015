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
            $messages['ce.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['ce.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        foreach($this->request->get('penalty_ce') as $key => $val)
        {
            $messages['penalty_ce.'.$key.'.integer'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['penalty_ce.'.$key.'.min'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        return $messages;
    }
}
