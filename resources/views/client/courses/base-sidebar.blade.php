@extends("client.base")

@section("content")
<style>
    @media (min-width: 700px) {
        main { margin-right: 300px !important; }
    }
</style>

<div class="row expanded align-center  content-area">
    @include('client.courses._tabs')

    {{-- Content --}}
    <div class="tabs-content column small-12 no-padding no-border no-margin base-sidebar-content">
        @if(isset($hasVideo))
            <div class="row video-container" style="text-align: center">
                <div class="flex-vid-container">
                    <div class="flex-video widescreen" >
                        <iframe src="https://www.youtube.com/embed/@yield('course.youtube_id')"
                                width="660"
                                height="376"
                                frameborder="0"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        @endif

        <div class="row align-center ">
            <h2 class="text-bold padding-20 column small-12 text-center text-medium">
                @yield('course.title')
            </h2>
            <div class="large-10 column ">
                @yield('course.content')
            </div>
        </div>

        <div class="exercise-sidebar">
            <h1 class="sidebar-title">
                <a href="{{ route('subjects.show', $course->subject->id) }}"
                   class="subject-name">
                    <i class="fa fa-arrow-right"></i>
                    {{ $course->subject->name }}
                </a>
                <br>
                {{ $course->name }}
            </h1>
            @yield('course.sidebar')
        </div>
    </div>
</div>
@endsection

