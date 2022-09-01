@extends('admin.base')

@section('content-header-title')
    {{ $exam->subject->name }}
    &dash;
    {{ trans('strings.theExamsNumber') }} : {{ $exam->id }}
@endsection

@section('content')
    @include('admin.exams.partials._update-form', [
        'method' => 'PUT',
        'url' => route('exams.update', $exam->id),
        'title' => trans('strings.edit')
    ])
@endsection