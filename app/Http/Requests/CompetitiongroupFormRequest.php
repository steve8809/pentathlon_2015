<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CompetitiongroupFormRequest extends Request
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
            'competition_id' => 'required',
            'date' => 'required|date|before:'.$tomorrow,
            'type' => 'required',
            'age_group' => 'required',
            'sex' => 'required',
        ];
    }
}
