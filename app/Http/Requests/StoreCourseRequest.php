<?php

namespace nataalam\Http\Requests;

use nataalam\Http\Requests\Request;

class StoreCourseRequest extends Request
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
            'level' => 'required',
            'branches' => '',
            'name' => 'required',
            'description' => '',
        ];
    }
}
