@extends('admin.base')

@section('title')
    <strong>Matière {{ $subject->name }} > Niveau {{$level->name}} > Cours {{ $course->name }}
    Lesson {{ $lesson->name }}</strong>
@endsection

@section('content')
<div class="container">
     <h2 class="col-sm-12 text-center">{{ $lesson->name }}</h2>
     <iframe class="col-sm-10 col-sm-offset-1" width="854" height="480"
     src="https://www.youtube.com/embed/{{ $lesson->youtube_id }}"
     frameborder="0" allowfullscreen></iframe>
     <hr class="col-sm-10 col-sm-offset-1"/>
     <p class="col-sm-10 col-sm-offset-1 text-center">
     {{ $lesson->description }}
     </p>
</div>
@endsection