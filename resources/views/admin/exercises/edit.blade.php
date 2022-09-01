@extends('admin.base')

@section('content-header-title')
    {{ $exercise->name }}

    <div class="pull-right">
        <a href="{{ route('admin.courses.show', $exercise->course->id) }}"
           class="btn btn-default">
            {{ $exercise->course->name }}
            &nbsp;
            <i class="fa fa-level-up"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="box box-primary">
        {{-- Header --}}
        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('strings.createAnExercise') }} </h3>
        </div>

        @include('admin.exercises._partials.update-form', [
            'url' => route('exercises.update', $exercise->id),
            'method' => 'PUT',
            'exercise' => $exercise,
        ])
    </div>
@endsection