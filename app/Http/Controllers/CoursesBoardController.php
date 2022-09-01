<?php

namespace nataalam\Http\Controllers;

use Illuminate\Http\Request;

use nataalam\Models\Course;
use nataalam\Http\Requests;
use nataalam\Http\Controllers\Controller;
use nataalam\Models\Lesson;
use nataalam\Models\Level;
use nataalam\Models\Subject;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoursesBoardController extends Controller
{
    public function index()
    {

    }

    public function viewLesson($lesson_video_id)
    {
        $lesson = Lesson::where(['youtube_id'=>$lesson_video_id])->first();
        return view("client.course-board.lesson")->with("lesson",$lesson);
    }
}
