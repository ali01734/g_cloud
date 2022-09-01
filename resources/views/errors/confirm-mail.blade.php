@extends('errors.base')

@section('error_title')
    {{ trans('strings.mailNotConfirmed') }}
@endsection

@section('error_message')
    <div class="row">
        <h1 class="column small-12 padding-30">
            {{ trans('strings.mailNotConfirmed') }}
        </h1>
    </div>
    <div class="row">
        <div class="columns small-12">
            <form action="{{ route('users.confirm.resend') }}" method="POST">
                {!! csrf_field() !!}

                <div class="row padding-30">
                    <label class="text-center columns small-12 no-padding">
                        {!! Recaptcha::render() !!}
                    </label>
                </div>

                <button type="submit"
                        class="button primary">
                    <i class="fa fa-envelope"></i>
                    {{ trans('strings.resendConfirmation') }}
                </button>
            </form>
        </div>
    </div>
@endsection