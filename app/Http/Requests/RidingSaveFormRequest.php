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

        foreach($this->request->get('riding_point') as $key => $val)
        {
            $rules['riding_point.'.$key] = 'integer|between:0,300|required_with:riding_time.'.$key.',horse_id.'.$key.'';

        }

        foreach($this->request->get('riding_time') as $key => $val)
        {
            $rules['riding_time.'.$key] = 'date_multi_format:"i:s.u"|required_with:riding_point.'.$key.',horse_id.'.$key.'';
        }

        foreach($this->request->get('horse_id') as $key => $val)
        {
            $rules['horse_id.'.$key] = 'required_with:riding_time.'.$key.',riding_point.'.$key.'';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('riding_point') as $key => $val)
        {
            $messages['riding_point.'.$key.'.integer'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['riding_point.'.$key.'.between'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['riding_point.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        foreach($this->request->get('riding_time') as $key => $val)
        {
            $messages['riding_time.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
            $messages['riding_time.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        foreach($this->request->get('horse_id') as $key => $val)
        {
            $messages['horse_id.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben hiba történt. Ellenőrizd az adatokat, segítség az információs sávokban.';
        }

        return $messages;
    }
}
