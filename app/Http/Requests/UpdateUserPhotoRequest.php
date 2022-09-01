<?php

namespace nataalam\Http\Requests;

use Auth;
use nataalam\Http\Requests\Request;

class UpdateUserPhotoRequest extends Request
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
            'photo' => [
                'required',
                'mimes:jpeg,png'
            ]
        ];
    }
}
