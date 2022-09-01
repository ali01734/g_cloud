{{-- TOP BAR CONTAINER --}}
<div class="top-bar" style="max-height: 50px">
    <div class="top-bar-title top-bar-right" style="margin-left: 10px">
        <span class="show-for-small-only">
            <button class="menu-icon" type="button" data-open="offCanvas"></button> &nbsp;
        </span>
        <a href="/">
            <img src="/images/small-logo.svg" alt="Nataalam logo" style="height: 2em">
        </a>
        &nbsp;
    </div>
    <div class="top-bar-left show-for-medium">
        <ul class="dropdown menu" data-dropdown-menu>
            <li>
                <a
                   class="button"
                   data-toggle="example-dropdown"
                   style="color: white; font-weight: bold">
                    {{ trans('strings.theCourses') }}&nbsp;
                    <i class="fa fa-caret-down"></i>
                </a>

                <div class="dropdown-pane" id="example-dropdown"
                     data-dropdown
                     data-hover="true"
                     data-hover-pane="true">
                    <div class="row"
                    >
                        @foreach($subjects as $i => $subject)
                            <div class="column medium-4 end">
                                <a href="{{ route('subjects.show', $subject) }}"
                                   class="nav-item"
                                   @if($i >= $subject->count() - 3) style="border: none" @endif>
                                    <div class="row medium-collapse">
                                        <div class="column medium-2 no-padding">
                                            <img src="{{ $subject->icon }}" alt="Subject icon" style="width: 100%;">
                                        </div>
                                        <div class="column medium-10" style="padding-right: 15px">
                                            <span class="text-bold">
                                                {{ $subject->name }}
                                            </span>
                                            <div class="description" style="font-weight: 100; white-space: normal">
                                                {{ $subject->description }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="top-bar-right show-for-medium">
        <ul class="dropdown menu" data-dropdown-menu>
            @if (Auth::user())
                <li>
                    <a href class="row username-container" style="">
                        <div class="row align-middle">
                            <div class="column">
                                <svg class="icon-down-dir"><use xlink:href="/images/icons.svg#icon-down-dir"></use></svg>
                            </div>
                            <div class="column username nowrap no-padding">
                                {{ Auth::user()->username }}
                            </div>
                            <div class="column ">
                                <div class="circle-photo no-wrap">
                                    <img src="{{ Auth::user()->photoUrl() }}" alt="Profile photo">
                                </div>
                            </div>
                        </div>
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
                            <form action="/logout" method="POST">
                                {{ csrf_field() }}
                                <button type="submit">
                                    <i class="fa fa-sign-out"></i>
                                    &nbsp;
                                    {{ trans('strings.logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="/login" class="button text-bold" style="color: white; margin: 10px">
                        <i class="fa fa-sign-in"></i>
                        &nbsp;
                        {{ trans('strings.login') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
