@extends('admin.base')

@section('content-header-title')
    {{ $subject->name }}
@endsection


@section('content')
    @include('admin.subjects._partials.update-form', [
        'title' => trans('strings.edit'),
        'method' => 'PUT',
        'url' => route('subjects.update', $subject->id),
        'values' => [
            'name' => $subject->name,
            'description' => $subject->description,
            'icon' => $subject->icon,
            'color' => $subject->color,
        ],
        'icons' => $icons
    ])
@overwrite