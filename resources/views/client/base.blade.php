<!doctype html>
<html lang="ar"
      dir="rtl"
      class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="description"
          content="{{ trans('strings.metaContent') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" type="image/svg" href="/images/leaf-logo.svg"/>

    <title>
        {{ trans('strings.nataalam') }}&dash; @yield('page_title')
    </title>

    <link rel="stylesheet" href="/styles/frontend.css">
    <link href="/styles/page-footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css">
    @yield("additional_stylesheets")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>
<body>
<div class="off-canvas position-right"
     data-transition="overlap"
     id="offCanvas"
     data-off-canvas
>
    <ul class="vertical menu" data-accordion-menu>
        @foreach($subjects as $subject)
            <li>
                <a href="{{ route('subjects.show', $subject->id) }}">
                    <img src="{{ $subject->icon }}"
                         alt=""
                         style="width: 32px;">
                    {{ $subject->name }}
                </a>
            </li>
        @endforeach
        <li><hr></li>
        <li>
            <ul class="dropdown menu" data-accordion-menu>
                @if (Auth::user())
                    <li>
                        <a href>
                            <i class="fa fa-user"></i>
                            &nbsp;
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="menu vertical">
                            <li>
                                <a href="{{ route('users.show', Auth::user()->id) }}">
                                    <i class="fa fa-user"></i>
                                    &nbsp;
                                    {{ trans('strings.profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.settings', Auth::user()->id) }}">
                                    <i class="fa fa-cogs"></i>
                                    &nbsp;
                                    {{ trans('strings.theSettings') }}
                                </a>
                            </li>
                            @if (Auth::user() and Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.index') }}">
                                        <i class="fa fa-cog"></i>
                                        &nbsp;
                                        {{ trans('strings.controlPanel') }}
                                    </a>
                                </li>
                                <li> <hr> </li>
                            @endif

                            <li>
                                <a href="/logout">
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp;
                                    {{ trans('strings.logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="/login">
                            <i class="fa fa-sign-in"></i>
                            &nbsp; {{ trans('strings.login') }}
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</div>
<div class="off-canvas-content" data-off-canvas-content>
    {{-- Google analytics --}}
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-76524315-1', 'auto');
        ga('send', 'pageview');

    </script>
    <header>
        @include('client/_topbar')
    </header>

    <main class="row align-center expanded" class="bg-white">
        @yield("content")
    </main>

    @include('client/_footer')
</div>
<script src="/gulp-build/bundle.js"></script>
<script src="/js/prevent.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


@if(Session::has('error'))
    <script>
        sweetAlert("", "{{ Session::get('error') }}", "error");
    </script>
@elseif(Session::has('success'))
    <script>
        sweetAlert("", "{{ Session::get('success') }}", "success");
    </script>
@endif

@yield('scripts')


</body>
</html>

