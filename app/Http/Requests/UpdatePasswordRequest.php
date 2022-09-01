<?php

namespace nataalam\Http\Requests;

use Auth;
use nataalam\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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
            'password' => ['required', 'old_password'],
            'new_password' => ['required', 'confirmed', 'min:8'],
            'new_password_confirmation' => ['required'],
        ];
    }

}
