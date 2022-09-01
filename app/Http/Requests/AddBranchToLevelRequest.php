<?php

namespace nataalam\Http\Requests;


class AddBranchToLevelRequest extends Request
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
        $id = $this->route('id');
        return [
            'branch' => [
                'exists:branches,id',
                "unique:branch_level,branch_id,NULL,NULL,level_id,$id",
            ]
        ];
    }


}
