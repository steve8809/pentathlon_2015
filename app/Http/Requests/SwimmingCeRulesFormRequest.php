<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SwimmingCeRulesFormRequest extends Request
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
            'swimming_time' => 'date_multi_format:"i:s.u"|required',
            'ce_time' => 'date_multi_format:"i:s.u"|required',
            'swimming_dist' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'ce_dist' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
        ];
    }
}
