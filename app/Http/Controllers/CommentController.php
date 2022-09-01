<?php

namespace nataalam\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use nataalam\Http\Requests\DeleteCommentRequest;
use nataalam\Models\Comment;
use nataalam\Models\Exercise;
use nataalam\Http\Requests;
use nataalam\Http\Requests\StoreCommentRequest;
use nataalam\Models\Lesson;
use nataalam\Models\Subject;

class CommentController extends Controller
{
    public function indexInAdmin(Request $request)
    {
        $comments = Comment
            ::orderBy('created_at', 'DESC')
            ->paginate($request->get('page_size', 10));

        $reportedComments = Comment
            ::rightJoin('user_reported_comment', 'comment_id', '=', 'id')
            ->select('*', DB::raw('count(user_reported_comment.user_id) as ct'))
            ->groupBy('id')
            ->orderBy('ct', 'DESC')
            ->paginate($request->get('page_size', 10));

        return view(
            'admin.comments.index',
            compact('comments', 'reportedComments')
        );
    }

    public function report($id) {
        $user = Auth::user();
        $comment = Comment::findOrFail($id);

        $alreadyReported = DB
            ::table('user_reported_comment')
            ->where('user_id', $user->id)
            ->where('comment_id', $id)
            ->get();
        if (empty($alreadyReported))
            $comment->reporters()->attach($user);

        return redirect()->back();
    }

    public function blockReporting($id) {
        $comment = Comment::findOrFail($id);
        $comment->reporting_blocked = true;
        $comment->save();
        return redirect()->back();
    }

    public function clearReports($id) {
        $comment = Comment::findOrFail($id);
        $comment->reporters()->detach();
        return redirect()->back();
    }

    private function storeInContent($content, $request, $foreign) {
        $comment = new Comment($request->all());

        $comment->{$foreign} = $content->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
    }

    public function storeInExercise(StoreCommentRequest $request, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $this->storeInContent($exercise, $request, 'exercise_id');

        return redirect()->back();
    }

    public function storeInLesson(StoreCommentRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->storeInContent($lesson, $request, 'lesson_id');

        return redirect()->back();
    }

    public function storeInSubjectAsBacComment(StoreCommentRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $this->storeInContent($subject, $request, 'bac_subject_id');

        return redirect()->back();
    }

    public function storeReplyInContent(StoreCommentRequest $req, $comment)
    {
        $reply  = new Comment($req->all());

        $reply->replyTo = $comment->id;
        $reply->user_id = Auth::user()->id;
        $reply->save();
    }

    public function storeReply(StoreCommentRequest $req, $id)
    {
        $comment = Comment::findOrFail($id);
        $this->storeReplyInContent($req, $comment);

        return redirect()->back();
    }

    /**
     * @param DeleteCommentRequest $request for authorization
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @noinspection PhpUnusedParameterInspection
     */
    public function destroy(Comment $comment, DeleteCommentRequest $request) {
        $comment->delete();
        return redirect()->back();
    }
}
