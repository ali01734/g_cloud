<?php

namespace nataalam\Http\Requests;

use nataalam\Models\Comment;

class DeleteCommentRequest extends RulessRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = $this->route('comment');
        return $comment->user_id === \Auth::user()->id || \Auth::user()->is_admin;
    }
}
