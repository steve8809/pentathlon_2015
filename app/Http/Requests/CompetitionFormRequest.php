<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CompetitionFormRequest extends Request
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
        $tomorrow = Carbon::tomorrow()->toDateString();
        return [
            'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'country_id' => 'required',
            'town' => 'required|alpha_spaces',
            'host' => 'required||regex:/(^[A-Za-z0-9 ]+$)+/',
            'date' => 'required|date|before:'.$tomorrow,
            'category' => 'required',
        ];
    }
}
