<?php

namespace nataalam\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Input;
use nataalam\Models\Branch;
use nataalam\Models\Course;
use nataalam\Models\Exercise;
use nataalam\Http\Controllers\Controller;
use nataalam\Http\Requests;
use nataalam\Http\Requests\StoreCourseRequest;
use nataalam\Models\Lesson;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class CourseController extends Controller
{
    public function showInFrontend($id)
    {
        return redirect(route('lessons.index', $id));
    }

    public function showInAdmin($id)
    {
        $course = Course::findOrFail($id);
        $lessons = Lesson
            ::where('course_id', $id)
            ->paginate(10, ['*'], 'page_lessons');

        $exercises = Exercise
            ::where('course_id', $id)
            ->paginate(10, ['*'], 'page_exercises');

        return view(
            'admin.courses.show',
            compact('course', 'lessons', 'exercises')
        );
    }

    public function createInAdmin($id)
    {
        $levels = Level::all();
        $subject = Subject::findOrFail($id);
        $levelsOptions = $this->getLevelsOptions($levels);

        return view(
            'admin.courses.create',
            compact('subject', 'levels', 'levelsOptions')
        );
    }

    protected function getLevelsOptions($levels)
    {
        $levelsOptions = [];
        foreach ($levels as $level)
            $levelsOptions[$level->id] = $level->name;
        return $levelsOptions;
    }

    /**
     * Show edit form in admin UI
     * @param $id The id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editInAdmin($id)
    {
        $levels = Level::all();
        $course = Course::findOrFail($id);
        $levelsOptions = $this->getLevelsOptions($levels);

        return view(
            'admin.courses.edit',
            compact('course', 'levels', 'levelsOptions')
        );
    }

    public function store(StoreCourseRequest $req, Subject $subject)
    {
        $course = new Course($req->all());
        $course->level_id = $req->input('level');
        $course->subject_id = $subject->id;

        DB::transaction(function() use ($course, $req) {
            $course->save();

            if ($req->has('branches')) {
                $branches = array_keys($req->input('branches'));
                $course->branches()->sync($branches);
            }

            $course->save();
        });

        return redirect(
            route(
                'admin.courses.show',
                ['id' => $course->id]
            )
        );
    }

    public function update(StoreCourseRequest $req, Course $course) {
        $course->update($req->all());

        if ($req->has('branches')) {
            $branches = array_keys($req->get('branches'));
            $course->branches()->sync($branches);
        }
        $course->level_id = $req->get('level');

        $course->save();

        return redirect(
            route(
                'admin.subjects.show',
                ['id' => $course->subject]
            )
        );
    }

    public function destroy(Course $course, Request $request) {
        $course->delete();
        $request->session()->flash('success', 'courseDeleteSuccess');

        return redirect()->back();
    }

    public function jsonIndex(Subject $subject, Level $level, Branch $branch)
    {
        $equalsId = function ($related) {
            return function($q) use($related) {
                return $q->where('id', $related->id);
            };
        };

        $courses = Course
            ::whereHas('level', $equalsId($level))
            ->whereHas('subject', $equalsId($subject))
            ->whereHas('branches', $equalsId($branch))
            ->get();

        return $courses;
    }
}
