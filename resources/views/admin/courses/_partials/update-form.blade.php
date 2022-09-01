@extends('_partials.form')

@section('form-title')
    {{ $title }}
@endsection

@section('content')

<div>
    <div>
        {{-- Level --}}
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{  trans('strings.theLevel')  }}
            </label>
            <div class="col-sm-10">
                {!!
                    Form::select(
                        'level',
                        $levelsOptions,
                        isset($course) ? $course->level->id : 0,
                        ['class' => 'form-control']
                     )
                 !!}
            </div>
        </div>

        {{-- Branches --}}
        <div class="form-group">
            <label class="col-sm-2 control-label">
                {{trans('strings.theBranches')}}
            </label>
            <div id="branches-container" class="checkbox col-xs-9">

                {{-- On level change, braches will be put here --}}

            </div>
        </div>

        <hr>

        {{-- Name --}}
        <div class="form-group">
            {!!
                Form::label(
                    'name',
                    trans('strings.name'),
                    ['class' => 'col-sm-2 control-label']
                )
             !!}

            <div class="col-sm-10">
                <input type="text"
                       name="name"
                       value="{{ isset($values['name']) ? $values['name'] : '' }}"
                       class="form-control"
                       required>
            </div>
        </div>

        {{-- Description --}}
        <div class="form-group">
            {!! Form::label('description', trans('strings.description'), ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
                {!! Form::textarea('description', isset($values['description']) ? $values['description'] : '', [
                    'class' => 'form-control',
                    'placeholder' => 'Description',
                    ])
                !!}
            </div>
        </div>
    </div>
</div>


@if (isset($course))
    @foreach($course->branches as $branch)
        <input type="hidden"
               name="hidden-branches[]"
               value="{{$branch->id}}">
    @endforeach
@endif


<script>
     (function(){
        document.addEventListener('DOMContentLoaded', main);

        function main() {
            updateBranches();
            document
                .querySelector('[name="level"]')
                .addEventListener('change', updateBranches);
        }

        function updateBranches() {
            var levelId = document.querySelector('[name="level"]').value;
            var url = '/levels/' + levelId + '/branches';
            fetch(url, { method: 'get'})
                .then(toJson)
                .then(handleData)
                .catch(handleErrors);
        }

        function toJson(res) {
            return res.json();
        }

        function handleData(json) {
            var container = document.getElementById('branches-container');
            var setBranches = getSetBranches();

            container.innerHTML = '';
            json.forEach(function(branch) {
                var check = setBranches.includes(branch.id) ? 'checked' : '';
                var input =
                        '<input name="branches[' + branch.id + ']" ' +
                        '       type="checkbox" ' +
                        '   ' + check + '>';

                container.innerHTML +=
                        '<div class="col-sm-4">' +
                        '<label> ' + input + branch.name + '</label> &nbsp; ' +
                        '</div>';
            });
        }

        function getSetBranches() {
            var inputs = document.querySelectorAll('[name="hidden-branches[]"]');
            return Array.prototype.slice.call(inputs).map(function(input) {
                return input.value;
            });
        }

        function handleErrors(err) {
            console.log(err);
            alert('error fetching data from server');
        }

    })();
</script>


@overwrite