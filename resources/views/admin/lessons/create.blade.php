@extends("admin.base")

@section('content-header-title')
    <a href="{{ route('admin.courses.show', $course->id) }}">
        {{ $course->name }}
    </a>
@endsection

@section('content')
    @include('admin.lessons.partials.update-form', [
        'title' => trans('strings.createALesson'),
        'method' => 'POST',
        'url' => route('lessons.store', $course->id),
        'formTitle' => trans('strings.addALesson'),
    ])
@overwrite