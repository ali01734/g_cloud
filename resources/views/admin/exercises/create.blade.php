@extends('admin.base')

@section('content-header-title')
    {{ $course->name }}
@endsection

@section('content')
    <div class="box box-primary">
        {{-- Header --}}
        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('strings.createAnExercise') }} </h3>
        </div>

        @include('admin.exercises._partials.update-form', [
            'url' => route('exercises.store', $course->id),
            'method' => 'POST',
        ])
    </div>

@endsection
