@extends("client.base")

@section("page_title")
    {{ trans('strings.subjectList') }}
@endsection

@section("content")
    <div class="callout callout-success blue-hero">
        <h1 class="centered-content">
            {{ $branch->name }}
        </h1>
        <div class="text-center">
            <span>
                {{ $level->name }}
            </span>
        </div>

        <div class="text-center">
            <a href="{{ route('subjects.show', $subject->id) }}">
                {{ $subject->name }}
            </a>
        </div>
    </div>

    <section class="row">
        <h2> {{ trans('strings.courses') }} </h2>
        <nav class="row" data-equalizer>
            @if (count($courses) == 0)
                <div class="column medium-3">
                    <div class="callout">
                        {{ trans('strings.noCoursesHere') }}
                    </div>
                </div>
            @else
                @foreach($courses as $course)
                    <div class="column medium-3">
                        <a href="{{ route('lessons.index', $course->id) }}" class="">
                            <div class="callout hover-grey transition">
                                {{ $course->name }}
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </nav>
    </section>
@endsection