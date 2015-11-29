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
            $messages['swimming.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben az időeredmény megadása nem a következő formátumban történt vagy a beírt érték nem valós: pp:mm.ss - pl.: 02:30.00';
            $messages['swimming.'.$key.'.required_with'] = 'A pirossal jelölt mezőkben az időeredmény megadása kötelező.';
        }

        foreach($this->request->get('penalty_swimming') as $key => $val)
        {
            $messages['penalty_swimming.'.$key.'.integer'] = 'A pirossal jelölt mezőkben egész számot kell megadni.';
            $messages['penalty_swimming.'.$key.'.between'] = 'A pirossal jelölt mezőkben megadott szám értékének 0 és 50 közöttinek kell lennie.';
        }

        return $messages;
    }
}
