<?php

namespace nataalam\Http\Requests;

class StoreExamRequest extends AuthorizedRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'courses' => [
                'required',
                'filled',
                'exists:courses,id'
            ],
            'exam' => [
                'file',
                'required',
                'mimes:pdf',
            ],
            'correction' => [
                'file',
                'mimes:pdf',
            ],
            'description' => [
                'max:255',
            ],
            'branches' => ['required']
        ];
    }
}
