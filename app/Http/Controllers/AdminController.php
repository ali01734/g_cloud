<?php

namespace nataalam\Http\Controllers;

use nataalam\Models\Branch;
use nataalam\Models\Comment;
use nataalam\Http\Requests;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'admin.index',
            [
                'subjectCount' => Subject::count(),
                'levelCount' => Level::count(),
                'commentCount' => Comment::count(),
                'branchCount' => Branch::count(),
            ]
        );
    }
}
