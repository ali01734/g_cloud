@extends('admin.base')

@section('content-header-title')
    {{ $subject->name }}
@endsection

@section('content')
    @include('admin.bacs.partials._update-form', [
        'url' => route('bacs.update', $bac),
        'method' => 'PUT',
    ])
@endsection
