<?php

namespace nataalam\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use nataalam\Models\Course;
use nataalam\Models\Exercise;
use nataalam\Http\Requests;
use nataalam\Http\Controllers\Controller;
use nataalam\Http\Requests\StoreExerciseRequest;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ExerciseController extends Controller
{
    public function indexInFrontend($courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->exercises->isEmpty())
            return view('client.exercises.empty', compact('course'));
        else
            return redirect()->action(
                'ExerciseController@showInFrontend',
                $course->exercises->first()->id
            );
    }

    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showInFrontend($id)
    {
        $exercise = Exercise::findOrFail($id);
        $difficulty = $exercise->difficulty;
        $exercises = $exercise->course->exercises()
            ->where('difficulty', $difficulty)
            ->orderBy('id')
            ->get();
        $comments = $exercise
            ->comments()
            ->whereNull('replyTo')
            ->orderBy('created_at', 'DESC')
            ->paginate(50);
        $postUrl = route('exercises.comments.store', $exercise->id);
        $replyUrl = function($params) {
            return route('replies.store', $params);
        };

        $vars = [
            'exercises' => $exercises,
            'exercise' => Exercise::findOrFail($id),
            'difficulty' => $difficulty,
            'course' => $exercise->course,
            'subject' => $exercise->course->subject,
            'level' => $exercise->course->level,
            'comments' => $comments,
            'postUrl' => $postUrl,
            'replyUrl' => $replyUrl,
        ];

        if ($exercise->youtube_id)
            $vars['hasVideo'] = true;

        return view('client.exercises.show', $vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $courseId
     * @return \Illuminate\Http\Response
     */
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);

        return view('admin.exercises.create')->with('course', $course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExerciseRequest $request
     * @param $courseId integer The id of the course
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExerciseRequest $request, $courseId)
    {
        try {
            $exercise = new Exercise($request->all());
            $course = Course::findOrFail($courseId);
            $course->exercises()->save($exercise);
            $exercise->moveImagesToStorage();
            $exercise->save();

            DB::commit();
            $request
                ->session()
                ->flash('success', 'exerciseStoreSuccess');
            return redirect()->route('admin.courses.show', $courseId);

        } catch (FileException $e) {
            DB::rollback();
            $request
                ->session()
                ->flash('error', 'Error moving Photos, please contact admin');
            return redirect()->back();
        }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('admin.exercises.edit', compact('exercise', 'course'));
    }


    public function destroy(Exercise $exercise, Request $request)
    {
        $exercise->delete();
        $request->session()->flash('success', 'exerciseDeleteSuccess');

        return redirect()->back();
    }

    public function update(Exercise $exercise, StoreExerciseRequest $req)
    {
        try {
            DB::beginTransaction();
            $exercise->update($req->all());
            $exercise->save();
            $exercise->moveImagesToStorage();
            $exercise->save();

            DB::commit();
            $req->session()->flash('success', 'exerciseUpdateSuccess');
            return redirect(route('admin.courses.show', $exercise->course->id));

        } catch (FileException $exception) {
            DB::rollBack();
            $req->session()->flash('error', 'Photos error, contact admin!!');
            return redirect()->back();
        }
    }
}
