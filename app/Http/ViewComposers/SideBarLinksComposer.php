<?php

namespace nataalam\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use nataalam\Models\Branch;
use nataalam\Models\Comment;
use nataalam\Models\Level;
use nataalam\Models\Subject;


class SideBarLinksComposer
{

    /**
     * Bind data to the view
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('sideBarLinks', [
            [
               'href' => route('admin.levels.index'),
               'fa' => 'fa-graduation-cap',
               'text' => trans('strings.theLevels'),
               'count' => Level::count(),
            ],
            [
                'href' => route('admin.subjects.index'),
                'fa' => 'fa-book',
                'text' => trans('strings.subjects'),
                'count' => Subject::count(),
            ],
            [
                'href' => route('admin.comments.index'),
                'text' => trans('strings.theComments'),
                'count' => Comment::count(),
                'fa' => 'fa-comment',
            ],
            [
                'href' => route('admin.branches.index'),
                'text' => trans('strings.theBranches'),
                'count' => Branch::count(),
                'fa' => 'fa-code-fork',
            ],
        ]);
    }
}