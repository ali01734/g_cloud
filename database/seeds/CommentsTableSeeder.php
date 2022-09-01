<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use nataalam\Models\Comment;
use nataalam\Models\Exercise;
use nataalam\Models\Lesson;
use nataalam\Models\Subject;
use nataalam\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Make some comments
     * @param $content
     * @param array $users
     * @param string $foreign
     */
    private function makeComments($content, Collection $users, string $foreign)
    {
        return factory(Comment::class, 30)
            ->make()
            ->each(function($comment) use($content, $users, $foreign) {
                $comment->{$foreign} = $content->id;
                $comment->user_id = $users->random(1)->id;
            })
            ->toArray();
    }

    /**
     * Add replies to some comments
     * @param Collection $users
     */
    private function insertReplies(Collection $users) {
        $commentWtReplies = array_filter(
            DB::table('comments')->select('id')->get(),
            function() { return rand(1,5) === 1; }
        );

        $repsToInsert = [];
        foreach($commentWtReplies as $comment) {
            $reps = factory(Comment::class, 3)->make();

            foreach($reps as $reply) {
                $reply->user_id = $users->random(1)->id;
                $reply->replyTo = $comment->id;
            }

            $repsToInsert = array_merge($repsToInsert, $reps->toArray());
        }

        DB::table('comments')->insert($repsToInsert);
    }

    private function insertComments(Collection $users) {
        $exercises = Exercise::take(10);
        $lessons = Lesson::take(10);
        $subjects = Subject::all();

        $comments = [];
        foreach ($exercises as $exercise)
            $comments = array_merge(
                $comments,
                $this->makeComments($exercise, $users, 'exercise_id')
            );

        foreach ($lessons as $lesson)
            $comments = array_merge(
                $comments,
                $this->makeComments($lesson, $users, 'lesson_id')
            );


        foreach ($subjects as $subject) {
            $comments = array_merge(
                $comments,
                $this->makeComments($subject, $users, 'bac_subject_id')
            );
            $comments = array_merge(
                $comments,
                $this->makeComments($subject, $users, 'regional_subject_id')
            );
        }

        DB::table('comments')->insert($comments);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $this->insertComments($users);
        $this->insertReplies($users);
        $this->reportSomeComments();
    }

    private function reportSomeComments() {
        $users = User::all();
        $comments = Comment::all();

        $comments->random(10)->each(function($cmt) use ($users) {
            $cmt->reporters()->attach($users->random(rand(1,9)));
            $cmt->save();
        });
    }
}
