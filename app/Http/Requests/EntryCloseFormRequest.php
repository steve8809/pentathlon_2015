<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EntryCloseFormRequest extends Request
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
            'bouts_per_match' => 'required|integer|between:0,5',
            'fencing_bouts' => 'required|integer|between:0,60',
            'riding_time_limit' => 'required|date_multi_format:"i:s.u"'
        ];
    }
}
