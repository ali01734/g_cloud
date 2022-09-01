@extends('admin.base')

@section('content-header-title')
    {{ $lesson->name }}
@endsection

@section('content')

    @include('admin.lessons.partials.update-form', [
        'method' => 'PUT',
        'url' => route('lessons.update', $lesson->id),
        'formTitle' => trans('strings.editALesson')
    ])
@endsection