@extends('client.courses.base-sidebar')

@section('course.sidebar')
    <div class="overflow-scroll no-padding">
        <ul class="no-ul">

        </ul>
    </div>
@endsection

@section('course.content')
    <div class="row">
        <div class="exercise-content">
            <div class="callout primary"> {{ trans('strings.thereAreNoLessons') }} </div>
        </div>

    </div>
@endsection


