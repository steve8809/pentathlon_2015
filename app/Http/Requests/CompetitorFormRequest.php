<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CompetitorFormRequest extends Request
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
        $today = Carbon::now()->toDateString();
        return [
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'sex' => 'required',
            'birthday' => 'required|date|before:'.$today,
            'country_id' => 'required',
            'club_id' => 'required',
        ];
    }
}
