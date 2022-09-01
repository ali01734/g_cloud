<?php

namespace nataalam\Http\Requests;

use Auth;
use nataalam\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() == $this->route('user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch' => ['exists:branches,id'],
            'level' => ['exists:levels,id'],
            'school' => [],
            'city' => ['exists:cities,id'],
        ];
    }
}
