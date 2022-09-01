<?php

namespace nataalam\Http\Controllers;

use nataalam\Http\Requests;
use nataalam\Models\Subject;
use nataalam\Models\Level;
use nataalam\Models\Course;

class ClientCourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param $subjectId integer id of the subject
     * @param $levelId integer id of the level
     * @param $courseId integer id of the course
     * @return \Illuminate\Http\Response
     */
    public function show($subjectId, $levelId, $courseId)
    {
        $vars = [
            'subject' => Subject::findOrFail($subjectId),
            'level' => Level::findOrFail($levelId),
            'course' => Course::findOrFail($courseId)
        ];
        return view('client.courses.show')->with($vars);
    }
}
