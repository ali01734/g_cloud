<?php

namespace nataalam\Http\Controllers;

use Illuminate\Http\Request;

use nataalam\Models\Course;
use nataalam\Http\Requests;
use nataalam\Http\Controllers\Controller;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("client.index");
    }


    public function subject($id)
    {
        $subject = Subject::find($id);
        return view("client.subject-menu")->with("subject",$subject);
    }

    public function levelMenu($id)
    {
        $level = Level::find($id);
        return view("client.level-menu")->with("level",$level);
    }

    public function course($id)
    {
        $course = Course::find($id);
        return view("course.course-menu")->with("course",$course);
    }

    public function subjects($count,$page)
    {
        $subjects = Subject::take($count)->offset($page-1)->get();
        return view("subject.client-menu");
    }
}
