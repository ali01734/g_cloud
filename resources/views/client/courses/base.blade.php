@extends("client.base")

@section("content")
    @include('client.courses._tabs')
    <div class="column small-12">
        <div class="tabs-content no-border padding-top-25">
            <div class="row expanded align-center course-content-container">
                <div class="column large-9">
                    @yield('course.content')
                </div>
            </div>
        </div>
    </div>
@endsection

