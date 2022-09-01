@extends('admin.base')

@section('content-header-title')
    {{$course->name}}

    <div class="pull-right">
        <a href="{{ route('admin.subjects.show', $course->subject->id) }}"
           class="btn btn-warning">
            {{ $course->subject->name }} &nbsp;
            <i class="fa fa-level-up"></i>
        </a>
    </div>

@endsection

@section('content')
    @include('admin.courses._partials.update-form', [
        'method' => 'PUT',
        'title' => trans('strings.edit'),
        'url' => route('courses.update', ['id' => $course->id]),
        'values' => array('name' => $course->name, 'description' => $course->description)
    ])
@overwrite