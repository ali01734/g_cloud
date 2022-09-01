@extends('client.courses.base-sidebar')

@section('course.title')
    {{ $lesson->name }}
@endsection

@section('course.sidebar')
    <div class="overflow-scroll no-padding">
        <ul class="no-ul">
            @foreach($course->lessons as $lessonItem)
                <li class="column no-margin no-padding">
                    <a  href="{{ route('lessons.show', $lessonItem->id) }}">
                        <p class="play-vertical-line sidebar-item {{ $lesson->id == $lessonItem->id ? 'selected' : '' }}">
                            <i class="fa fa-play-circle"></i>
                             &nbsp;
                            {{ $lessonItem->name }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('course.youtube_id', $lesson->youtube_id)

@section('course.content')
    <div class="row">
        <div class="column">
            {!! $lesson->text !!}
        </div>
    </div>
    @include('client.comments.index')
@endsection


