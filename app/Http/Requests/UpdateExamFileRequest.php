<?php

namespace nataalam\Http\Requests;

use nataalam\Http\Requests\Request;

class UpdateExamFileRequest extends StoreExamRequest
{
    public function rules()
    {
        $rules = parent::rules();
        unset($rules['exam']);
        unset($rules['correction']);

        return $rules;
    }
}
