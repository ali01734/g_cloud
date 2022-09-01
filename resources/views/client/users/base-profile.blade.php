@extends('client.base')

@section('content')
    <div class="column small-12 callout callout-success blue-hero margin-0" style="padding: 40px 40px 30px;">

        <div class="row expanded align-center no-margin">
            <div class="column small-12">
                <div class="profile-photo">
                    @if(Auth::user() and Auth::user()->id == $user->id)
                        <label class="photo-edit-button" for="photo-input">
                            <i class="fa fa-camera"></i>
                        </label>
                    @endif
                    @if ($user->hasPhoto())
                        <img src="/storage/users/photos/{{ $user->id }}.jpg"
                             alt="Profile photo">
                    @else
                        <img src="/images/default-photo.svg" alt="Profile photo">
                    @endif
                </div>
            </div>
            <div class="column small-12">
                {!!
                    Form::open([
                        'url' => route('users.photos.update', $user),
                        'method' => 'PATCH',
                        'name' => 'photoForm',
                        'enctype' => "multipart/form-data",
                        'class' => 'hidden',
                    ])
                !!}
                <div class="column medium-4 medium-offset-4"
                     style="text-align: center">
                    <input type="file"
                           name="photo"
                           class="light-border"
                           id="photo-input"
                           accept=".png, .jpg, .jpeg"
                           onchange="photoForm.submit()">
                </div>
                <button type="submit"
                        class="button small">
                    <i class="fa fa-check"></i>
                </button>
                {!! Form::close() !!}
            </div>
            <div class="row center">
                <h2 class="column small-12" style="font-size: 24px">
                    {{ $user->firstName }} {{ $user->lastName }}
                    <br>
                    <small> {{ $user->username }} </small>
                </h2>
            </div>
        </div>

        @if($user->isCurrent() && !$user->verified)
        <div class="row align-center">
            <div class="column large-6">
                <div class="callout alert">
                    <i class="fa fa-info-circle"></i> &nbsp;
                    {{ trans('strings.mailNotConfirmed') }}

                    (
                    <a href="{{ route('errors.confirm') }}" class="text-blue">
                        <i class="fa fa-envelope"></i>
                        &nbsp;
                        {{ trans('strings.resend') }}
                    </a>
                    )
                </div>
            </div>
        </div>
        @endif
    </div>

    <header class="bg-white">
        <nav class="centered-nav row">
            <ul class="tabs" style="display: inline-block">
                <li class="tabs-title is-active">
                    <a href="{{ route('users.show', $user->id) }}"
                       aria-selected="{{ Route::getCurrentRoute()->getName() == 'users.show' ? 'true' : 'false' }}">
                        <i class="fa fa-info-circle"></i> &nbsp;
                        {{ trans('strings.theInfo') }}
                    </a>
                </li>
                @if(Auth::user() && $user->id == Auth::user()->id)
                    <li class="tabs-title">
                        <a href="{{ route('users.settings', $user->id) }}"
                           aria-selected="{{ Route::getCurrentRoute()->getName() == 'users.settings' ? 'true' : 'false' }}">
                            <i class="fa fa-info-circle"></i> &nbsp;
                            {{ trans('strings.theSettings') }}
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </header>

    <div class="column small-12">
        <main class="tabs-content">
            <div class="column small-12">
                @if (count($errors) > 0)
                    <div class="callout alert column small-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li >{{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @yield('users.base-profile.content')
        </main>
    </div>
@endsection