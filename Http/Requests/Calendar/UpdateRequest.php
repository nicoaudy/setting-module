<?php

namespace Modules\Setting\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_working_time' => 'required|date_format:H:i|before_or_equal:end_working_time',
            'end_working_time' => 'required|date_format:H:i|after_or_equal:start_working_time',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
