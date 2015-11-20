<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FencingRulesFormRequest extends Request
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
            'bouts_250' => 'required|integer',
            'victory_points' => 'required|integer',
        ];
    }
}
