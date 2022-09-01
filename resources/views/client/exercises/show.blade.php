@extends('client.courses.base-sidebar')

@section('course.title')
    {{ $exercise->name }}
@endsection

@section('course.youtube_id', $exercise->youtube_id)

@section('course.sidebar')
    <div class="row no-margin margin-rl-10">
        @if (!$course->exercisesByDifficulty('easy')->isEmpty())
            <a class="button @if($difficulty == 'easy') bold primary @endif column small-4" href="{{ route('exercises.show', [ $course->exercisesByDifficulty('easy')->get(0)->id ]) }}">
                {{ trans('strings.easy')  }}
            </a>
        @else
            <span class="button column disabled small-4">
                {{ trans('strings.easy')  }}
            </span>
        @endif

        @if(!$course->exercisesByDifficulty('medium')->isEmpty())
            <a class="button @if($difficulty == 'medium') bold primary @endif column small-4" href="{{ route('exercises.show', [ $course->exercisesByDifficulty('medium')->get(0)->id ]) }}">
                {{ trans('strings.medium')  }}
            </a>
        @else
            <span class="button disabled column small-4">
                {{ trans('strings.medium')  }}
            </span>
        @endif

        @if (!$course->exercisesByDifficulty('hard')->isEmpty())
            <a class="button @if($difficulty == 'hard') bold primary @endif column small-4" href="{{ route('exercises.show', [ $course->exercisesByDifficulty('hard')->get(0)->id ]) }}">
                {{ trans('strings.hard')  }}
            </a>
        @else
            <span class="button column small-4">
                {{ trans('strings.hard')  }}
            </span>
        @endif
    </div>

    <div class="overflow-scroll">
        <ul class="no-ul">
            @foreach($exercises as $key => $ex)
                <li class="column no-margin no-padding">
                    <a class="column small-12 no-padding" href="{{ route('exercises.show', $ex->id) }}">
                        <p class="play-vertical-line sidebar-item {{ $exercise->id == $ex->id ? 'selected' : '' }}">
                            <i class="fa fa-play-circle"></i> &nbsp;
                            {{ $ex->name }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('course.content')
    <div class="row">
        <div>
            {!! $exercise->text !!}
        </div>

        <article class="callout column small-12 solution-container">
            <a href="#" class="solution-show-link">
                {{ trans('strings.showTheSolution') }}
            </a>
            <div class="solution-content solution-hidden">
                {!! $exercise->solution !!}
            </div>
        </article>
    </div>

    @include('client.comments.index')

    <script src="//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>
    <script>

        // Show solution
        window.addEventListener('DOMContentLoaded', function() {
            var link = document.querySelector('.solution-show-link');
            link.addEventListener('click', function(e) {
                document
                    .querySelector('.solution-content')
                    .classList
                    .remove('solution-hidden');
                link.remove();

                e.preventDefault();
            });
        });

    </script>
@endsection


