<?php

namespace nataalam\Http\Requests;

use nataalam\Http\Requests\Request;
use nataalam\Models\BacExamFile;

class StoreBacRequest extends Request
{
    public static function getRules() {
        return [
            'exam' => [
                'file',
                'mimes:pdf',
            ],
            'correction' => [
                'file',
                'mimes:pdf',
            ],
            'year' => [
                'required',
                'numeric',
                'max:' . date('Y'),
                'min:1990'
            ],
            'branches' => [
                'required',
                'exists:branches,id'
            ],
            'type' => [
                'required',
                'in:' . join(',', BacExamFile::$types)
            ]
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }
}
