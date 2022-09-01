<?php

namespace nataalam\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use nataalam\Models\Subject;


class TopBarComposer
{

    /**
     * Bind data to the view
     *
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('subjects', Subject::all());
    }
}