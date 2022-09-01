<div class="column small-12">
    <nav class="row align-center expanded">
        <ul class="tabs border-bottom-only">
            <li class="tabs-title is-active">
                <a href="{{ route('lessons.index', $course->id) }}"
                   aria-selected="{{ preg_match('/lessons/', Route::getCurrentRoute()->getName()) ? 'true' : 'false' }}">
                    <i class="fa fa-book"></i> &nbsp;
                    {{ trans('strings.course') }}
                </a>
            </li>
            <li class="tabs-title">
                <a href="{{ route('exercises.index', $course->id) }}"
                   aria-selected="{{ preg_match('/exercises/', Route::getCurrentRoute()->getName()) ? 'true' : 'false' }}">
                    <i class="fa fa-table"></i> &nbsp;
                    {{ trans('strings.exercises') }}
                </a>
            </li>
            <li class="tabs-title">
                <a href="{{ route('exams.index', $course->id) }}"
                   aria-selected="{{ preg_match('/exams/', Route::getCurrentRoute()->getName()) ? 'true' : 'false' }}">
                    <i class="fa fa-files-o"></i> &nbsp;
                    {{ trans('strings.exams') }}
                </a>
            </li>
        </ul>
    </nav>
</div>

