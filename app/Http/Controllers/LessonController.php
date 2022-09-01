<?php

namespace nataalam\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use nataalam\Models\Course;
use nataalam\Http\Requests;
use nataalam\Http\Requests\StoreLessonRequest;
use nataalam\Models\Lesson;
use nataalam\Models\Level;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class LessonController extends Controller
{
    public function indexInFrontend($courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->lessons->isEmpty())
            return view('client.lessons.empty', compact('course'));
        else
            return redirect()->action(
                'LessonController@showInFrontend',
                $course->lessons->first()->id
            );
    }

    public function editInAdmin(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Lesson $lesson, StoreLessonRequest $request)
    {

        try {
            DB::beginTransaction();
            $lesson->update($request->all());
            $lesson->save();
            $lesson->moveImagesToStorage();
            $lesson->save();

            DB::commit();
            $request->session()->flash('success', 'lessonUpdateSuccess');
            return redirect(route('admin.courses.show', $lesson->course->id));

        } catch(FileException $e) {
            DB::rollBack();
            $request->session()->flash('error', 'Photo error, contact admin!');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $lessonId integer The id of the lesson
     * @return \Illuminate\Http\Response
     */
    public function showInFrontend($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $course = $lesson->course;
        $comments = $lesson
            ->comments()
            ->whereNull('replyTo')
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
        $postUrl = route('lessons.comments.store', $lesson->id);
        $replyUrl = function($params) {
            return route('replies.store', $params);
        };

        $vars = [
            'subject' => $course->subject,
            'lesson' => $lesson,
            'course' => $course,
            'lessons' => $course->lessons,
            'level' => $course->level,
            'comments' => $comments,
            'postUrl' => $postUrl,
            'replyUrl' => $replyUrl,
        ];

        if ($lesson->youtube_id)
            $vars['hasVideo'] = true;

        return view('client.lessons.show', $vars);
    }

    public function createInAdmin(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    /**
     * @param Course $course
     * @param StoreLessonRequest $request
     * @return Redirect
     */
    public function store(Course $course, StoreLessonRequest $request)
    {
        try {
            DB::beginTransaction();

            $lesson = new Lesson($request->all());
            $course->lessons()->save($lesson);
            $lesson->save();
            $lesson->moveImagesToStorage();
            $lesson->save();

            $request->session()->flash('success', 'lessonStoreSuccess');
            DB::commit();
            return redirect(route('admin.courses.show', $course->id));

        } catch (FileException $e) {
            DB::rollBack();

            $request
                ->session()
                ->flash('error', 'Error moving Photos, please contact admin');
            return redirect()->back();
        }
    }

    public function destroy(Lesson $lesson, Request $request)
    {
        $lesson->delete();
        $request->session()->flash('success', 'lessonDeleteSuccess');

        return redirect()->back();
    }
}
