<?php

namespace Modules\Setting\Http\Requests\Workflow;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'division_id'       => 'required',
            'department_id'     => 'required',
            'application_name'  => 'required',
            'sequence'          => 'required|numeric',
            'approval_caption'  => 'required',
            'description'       => 'required',
            'back_to_requestor' => 'required',
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
