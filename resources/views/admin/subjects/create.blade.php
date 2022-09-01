@extends('admin.base')

@section('content-header-title')
    {{ trans('strings.subjects') }}
@endsection

@section('content')
    @include('admin.subjects._partials.update-form', [
        'method' => 'POST',
        'url' => route('subjects.store'),
        'title' => trans('strings.add'),
    ])
@overwrite