@extends('client.users.base-profile')

@section('users.base-profile.content')

    <section class="row column small-12 small-uncollapse hidden" id="edit-form" style="display: none">
        <form action="{{ Auth::user() ? route('users.update', Auth::user()->id) : '' }}"
              method="POST"
              name="levelForm"
              class="medium-6 columns padding-30 medium-offset-3">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="row">
                <div class="callout row">
                    <div class="medium-12 columns">
                        <label>
                            {{ trans('strings.theLevel') }}
                            <select name="level">
                                <option value=""
                                        {{ !$user->level ? 'selected' : '' }}>
                                </option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}"
                                            {{ $user->level == $level ? 'selected' : ''  }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="medium-12 columns">
                        <label>
                            {{ trans('strings.theBranch') }}
                            <select name="branch">
                                <option value=""></option>
                            </select>
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            {{ trans('strings.lEtablissement') }}
                            <input type="text"
                                   name="school"
                                   value="{{ isset($user->school) ? $user->school : '' }}">
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            {{ trans('strings.theCity') }}
                            <select name="city">
                                <option value=""
                                        {{ !$user->city ? 'selected' : '' }}>
                                </option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}"
                                            {{ $user->city == $city ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <div class="pull-left">
                            <a onclick="toggleForm()" class="button alert">
                                <i class="fa fa-ban"></i>
                                {{ trans('strings.cancel') }}
                            </a>
                            <button type="submit" class="button">
                                <i class="fa fa-check"></i>
                                {{ trans('strings.ok') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section class="row expanded align-center padding-30 small-uncollapse"
             id="info-card">
        <div class="columns medium-6">
            <div class="callout row">
                @if(Auth::user() and Auth::user()->id == $user->id)
                    <button onclick="toggleForm()" class="close-button" aria-label="Close alert" type="button">
                        <span aria-hidden="true">
                            <i class="fa fa-pencil"></i>
                        </span>
                    </button>
                @endif

                <label>
                    <strong>
                        {{ trans('strings.theLevel') }}
                    </strong>
                </label>
                <div class="callout columns medium-12">
                    {{ $user->level->name or ''}}
                </div>

                <label>
                    <strong>
                        {{ trans('strings.theBranch') }}
                    </strong>
                </label>
                <div class="callout columns medium-12">
                    {{ $user->branch->name or '' }}
                </div>

                <div class="columns medium-6">
                    <label>
                        <strong>
                            {{ trans('strings.lEtablissement') }}
                        </strong>
                    </label>
                    <div class="callout columns medium-12">
                        {{ $user->school or '' }}
                    </div>
                </div>

                <div class="columns medium-6">
                    <label>
                        <strong>
                            {{ trans('strings.theCity') }}
                        </strong>
                    </label>
                    <div class="callout columns medium-12">
                        {{ $user->city->name or '' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            levelForm.level.addEventListener('change', onLevelChange);

            function onLevelChange() {
                var levelId = levelForm.level.value;
                var url = "/levels/" + levelId + "/branches";

                $.getJSON(url, {}, updateBranches);
            }

            function updateBranches(data) {
                levelForm.branch.innerHTML = '';
                data.forEach(function(branch) {
                    levelForm.branch.innerHTML +=
                            '<option value="' + branch.id +'">' +
                            branch.name +'</option>';
                });
            }
        });
    </script>

    <script>
        function toggleForm() {
            $('#edit-form').toggle('slow');
            $('#info-card').toggle('slow');
        }
    </script>
@endsection
