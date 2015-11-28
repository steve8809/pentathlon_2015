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
            $rules['swimming.'.$key] = 'date_multi_format:"i:s.u"';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('swimming') as $key => $val)
        {
            $messages['swimming.'.$key.'.date_multi_format'] = 'A pirossal jelölt mezőkben az időeredmény megadása nem a következő formátumban történt vagy a beírt érték nem valós: pp:mm.ss - pl.: 02:30.00';
        }
        return $messages;
    }
}
