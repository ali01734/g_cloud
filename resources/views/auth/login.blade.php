@extends('client.base')
@section('additional_stylesheets')
    <link rel="stylesheet" href="/styles/user-form.css" />
@endsection
@section("page_title")
    تسجيل الدخول
@endsection
@section('content')

<div class="column small-12">
    <section class="row expanded emph-bg align-center no-margin">
        <section class="column large-6">
            <div class="callout  margin-20 padding-40">

                <h2> {{ trans('strings.welcomeLogin') }} </h2>
                <hr/>
                @if(Session::has('error'))
                    <div class="row">
                        <div class="callout alert small columns small-12" style="display: inline-block">
                            <i class="fa fa-info-circle"></i> &nbsp;
                            {{ trans('strings.' . Session::get('error')) }}
                        </div>
                    </div>
                @endif
                {{-- Social login--}}
                <div class="section row small-uncollapse expanded align-center">
                    <div class="columns">
                        <div class="row">
                            <a href="{{ route('auth.facebook') }}"
                               class="button column text-white margin-rl-10">
                                <i class="fa fa-facebook"></i> &nbsp;
                                Facebook login
                            </a>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="row">
                            <a href="{{ route('auth.google') }}"
                               class="button alert column margin-rl-10">
                                <i class="fa fa-google-plus"></i> &nbsp;
                                Google Login
                            </a>
                        </div>
                    </div>
                </div>
                <hr>

                {{-- Login form--}}
                {!!
                    Form::open([
                        'url' => '/login',
                        'method' => 'POST',
                        'class' => 'form row'
                    ])
                !!}

                {!! Form::label('email','البريد الاكتروني', ['class'=>'small-12 columns left']) !!}
                <input type="text" value="{{ old('email') }}" name="email" id="email"
                       class="small-12 columns left" autofocus />
                {!! Form::label('password','كلمة المرور', array('class'=>'small-12 columns left'))!!}
                <input type="password" id="password" name="password" class="small-12 columns left" />
                <div class="small-12 columns left">
                    <input type="checkbox" name="remember">
                    تذكرني
                </div>
                <div class="column small-12">
                    <div class="row">
                        <div class="columns ">
                            <div class="row align-center">
                                <button type="submit" class="button primary columns small-10">
                                    <i class="fa fa-sign-in"></i>
                                    دخول
                                </button>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="row align-center">
                                <a href="/register" class="button secondary columns small-10">
                                    <i class="fa fa-user-plus"></i>
                                    حساب جديد
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                @if(count($errors))
                    @foreach($errors->all() as $error)
                        <div class="alert-box small-10 small-offset-1 medium-6 medium-offset-3 columns left"
                             style="background-color : #ffb6c1;border:none"data-alert>
                            {{ $error }}

                        </div>
                    @endforeach

                    <script>
                        $(document)
                                .ready(function() {
                                    $('.alert-box').click(function() {
                                        $(this).remove();
                                    })
                                });
                    </script>

                @endif

                {!! Form::close() !!}


            </div>
        </section>
    </section>
</div>

@endsection