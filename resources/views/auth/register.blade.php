@extends('client.base')
@section('page_title', 'فتح حساب')

@section('additional_stylesheets')
    <link rel="stylesheet" href="/styles/user-form.css" />
@endsection

@section('content')

    <div class="row expanded emph-bg">
        <section class="medium-8 medium-centered large-5 padding-top-30 padding-bottom-30 small-11 small-centered">
            <div class="callout">

                <h2> {{ trans('strings.yourAreWelcome') }} </h2>
                <hr/>

                @if(count($errors))
                    @foreach($errors->all() as $error)
                        <div class="callout alert columns small-12">
                            <i class="fa fa-exclamation-triangle"></i> &nbsp;
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                {!!
                    Form::open([
                        'url' => '/register',
                        'method' => 'POST',
                        'class' => 'form row',
                    ])
                !!}
                <div class="row">
                    <label class="columns medium-6">
                        {{ trans('strings.firstName') }}
                        <input type="text"
                               value="{{ old('firstName') }}"
                               name="firstName"/>
                    </label>
                    <label class="columns medium-6">
                        {{ trans('strings.lastName') }}
                        <input type="text"
                               value="{{ old('lastName') }}"
                               name="lastName"/>
                    </label>
                    <label class="medium-12 columns">
                        {{ trans('strings.username') }}
                        <input type="text"
                               value="{{ old('username') }}"
                               name="username"/>
                    </label>
                    <label class="medium-12 columns">
                        {{ trans('strings.theEmailAddress') }}
                        <input type="text"
                               value="{{ old('email') }}"
                               name="email"
                               id="email"
                               required/>
                    </label>
                    <label class="medium-6 columns">
                        {{ trans('strings.password') }}
                        <input type="password"
                               id="password"
                               name="password"
                               required/>
                    </label>
                    <label class="medium-6 columns">
                        {{ trans('strings.confirmThePassword') }}
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               required/>
                    </label>
                    <div class="row padding-30">
                        <label class="text-center columns small-12 no-padding">
                            {!! Recaptcha::render() !!}
                        </label>
                    </div>
                </div>

                <div class="row small-uncollapse">
                    <div class="columns medium-6">
                        <button type="submit"
                                class="button primary columns small-12">
                            <i class="fa fa-check"></i>
                            &nbsp;
                            {{ trans('strings.register') }}
                        </button>
                    </div>
                    <div class="columns medium-6">
                        <a href="/login"
                           class="button secondary columns small-12">
                            <i class="fa fa-arrow-left"></i>
                            &nbsp;
                            {{ trans('strings.iHaveAnAccount') }}
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </section>
    </div>


@endsection