@extends('admin.base')

@section('content-header-title')
{{ $subject->name }}
@endsection

@section('content')
    @include('admin.exams.partials._update-form', [
        'method' => 'POST',
        'url' => route('exams.store', $subject->id),
        'title' => trans('strings.addAnExam')
    ])
@endsection