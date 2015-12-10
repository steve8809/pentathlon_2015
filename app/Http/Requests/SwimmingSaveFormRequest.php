<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SwimmingSaveFormRequest extends Request
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

        foreach($this->request->get('swimming') as $key => $val)
        {
            $rules['swimming.'.$key] = 'date_multi_format:"i:s.u"|required_with:penalty_swimming.'.$key.'';
        }

        foreach($this->request->get('penalty_swimming') as $key => $val)
        {
            $rules['penalty_swimming.'.$key] = 'integer|between:0,50';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach($this->request->get('swimming') as $key => $val)
        {
            $messages['swimming.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['swimming.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        foreach($this->request->get('penalty_swimming') as $key => $val)
        {
            $messages['penalty_swimming.'.$key.'.integer'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['penalty_swimming.'.$key.'.between'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        return $messages;
    }
}
