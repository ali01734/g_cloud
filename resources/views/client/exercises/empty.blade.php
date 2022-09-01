@extends('client.courses.base-sidebar')

@section('course.sidebar')

@endsection

@section('course.content')
    <div class="padding-30 exercise-content row">
        <div class="column">
            <div class="callout primary">
                {{ trans('strings.thereAreNoExercises') }}
            </div>
        </div>
    </div>
@endsection


