@extends('client.users.base-profile')

@section('users.base-profile.content')
    <div class="row collapse padding-30 expanded align-center">
        <div class="medium-3 columns">
            <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
                <li class="tabs-title is-active">
                    <a href="#panel1v" aria-selected="true">
                        <i class="fa fa-lock"></i>
                        <strong>
                            {{ trans('strings.changingPassword') }}
                        </strong>
                    </a>
                </li>
            </ul>
        </div>
        <div class="medium-9 columns">
            <div class="tabs-content no-border vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel no-border is-active" id="panel1v">
                    <div class="row expanded align-center">
                        <form action="{{ route('users.passwords.update', $user->id) }}"
                              method="POST"
                              class="column large-6 large-centered">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}
                            <label>
                                {{ trans('strings.currentPassword')  }}
                                <input type="password"
                                       name="password">
                            </label>
                            <label>
                                {{ trans('strings.newPassword')  }}
                                <input type="password"
                                       name="new_password">
                            </label>
                            <label>
                                {{ trans('strings.confirmThePassword')  }}
                                <input type="password"
                                       name="new_password_confirmation">
                            </label>
                            <button type="submit"
                                    class="button pull-left">
                                <i class="fa fa-check"></i>
                                {{ trans('strings.ok') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection