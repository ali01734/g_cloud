<?php

use nataalam\Models\Comment;
use nataalam\Models\Lesson;
use nataalam\Models\User;

class CommentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $lesson = Lesson::first();
        $user = User::first();
        $otherUser = User::where('id', '!=', $user->id)->first();

        $commentText = 'This is my comment';

        $comment = new Comment();
        $comment->text = $commentText;
        $comment->lesson_id = $lesson->id;
        $comment->user_id = $user->id;

        $comment->save();

        $url = "/lessons/$lesson->id";

        $this->be($user);
        $commentId = '#comment-'.$comment->id;
        $this->visit($url)
            ->see($commentText)
            ->seeElement($commentId)
            ->within($commentId, function() {
                $this->see(trans('strings.delete'));
            });


        $this->be($otherUser);
        $this
            ->visit($url)
            ->within($commentId, function() {
                $this->dontSee(trans('strings.delete'));
            });
    }
}
