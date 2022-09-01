{{--
    client/courses/show.blade.php

    The page that shows the content of a course. It lists it's lessons and
    exercises.

--}}

@extends("client.base")

@section("content")

    <div class="callout callout-success" >

        <h1 class="centered-content"> {{ $course->name }} </h1>
        <div class="centered-content disabled">
            {{ $course->level->name }}
        </div>
        <div class="centered-content">
            <a href="{{ route('subjects.show', $course->level->subject->id) }}">
                {{ $course->level->subject->name }}
            </a>
        </div>
    </div>

    <div class="row top-bottom-md-pad">
        {{-- Lessons --}}
        <section>
            <h2> {{ trans('strings.courses') }} </h2>

            <section class="row large-uncollapse">
                @if ($course->lessons->count() > 0)
                    @foreach($course->lessons as $lesson)
                        <div class="large-3 medium-4 column end" >
                            <a class="callout success large-12 column"
                               href="{{ route('lessons.show', [$lesson->id]) }}">
                                {{ $lesson->name }}
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="large-12 medium-12 column end" >
                        <span class="callout disabled large-12 column">
                            {{ trans('strings.thereAreNoLessons') }}
                        </span>
                    </div>
                @endif
            </section>
        </section>

        {{-- Exercises --}}
        <section>
            <h2> {{ trans('strings.exercises') }} </h2>
            <section class="row large-uncollapse">

                <div class="medium-4 column">
                    @if(!$easy->isEmpty())
                        <a href="{{ route('exercises.show', $easy->get(0)->id) }}" class="callout primary medium-12 column">
                            {{ trans('strings.easyExercises') }}
                            <div class="pull-left badge">{{ $easy->count() }}  </div>
                        </a>
                    @else
                        <span class="callout disabled bg-gray medium-12 column">
                            {{ trans('strings.easyExercises') }}
                            <div class="pull-left badge">{{ $easy->count() }}  </div>
                        </span>
                    @endif
                </div>

                <div class="medium-4 column">
                    @if(!$medium->isEmpty())
                        <a href="{{ route('exercises.show', $medium->get(0)->id) }}"
                           class="callout primary medium-12 column">
                            {{ trans('strings.mediumExercises') }}
                            <div class="pull-left badge">{{ $hard->count() }}  </div>
                        </a>
                    @else
                        <span class="callout disabled bg-gray medium-12 column">
                            {{ trans('strings.mediumExercises') }}
                            <div class="pull-left badge">{{ $medium->count() }}  </div>
                        </span>
                    @endif
                </div>

                <div class="medium-4 column">
                    @if(!$hard->isEmpty())
                        <a href="{{ route('exercises.show', $hard->get(0)->id) }}"
                           class="callout primary medium-12 column">
                            {{ trans('strings.hardExercises') }}
                            <div class="pull-left badge"> {{ $hard->count() }}  </div>
                        </a>
                    @else
                        <span class="callout disabled medium-12 column">
                                {{ trans('strings.hardExercises') }}
                            <div class="pull-left badge">{{ $hard->count() }}  </div>
                        </span>
                    @endif
                </div>

            </section>
        </section>

    </div>
@endsection