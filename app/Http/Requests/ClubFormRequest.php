<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClubFormRequest extends Request
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
            'name' => 'required|alpha_spaces_num_dot|unique:clubs,name,'.$this->id,
            'country' => 'required',
            'town' => 'required|alpha_spaces'
        ];
    }
}
