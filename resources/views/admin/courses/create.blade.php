@extends("admin.base")

@section('content-header-title')
    <a href="{{ route('admin.subjects.show', ['id' => $subject->id]) }}">
        {{ $subject->name }}
    </a>
@endsection

@section('content-header-title-small')
    {{ trans('strings.addACourse') }}
@endsection

@section('content')
    @include('admin.courses._partials.update-form', [
        'title' => trans('strings.addACourse'),
        'url' => route('courses.store', $subject->id),
    ])
@overwrite