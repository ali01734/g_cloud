
{{-- Form --}}
{!!
    Form::open([
        'method' => $method,
        'url' => $url
    ])
!!}
<div class="box-body">
    <div class="form-group">
        <label for="name-input">{{ trans('strings.name') }}</label>
        <input type="text"
               class="form-control"
               id="name-input"
               name="name"
               @if (isset($exercise)) value="{{ $exercise->name }}" @endif >
    </div>
    <div class="form-group">
        <label> Youtube ID </label>
        <input type="text"
               name="youtube_id"
               class="form-control"
               value="{{ isset($exercise) ? $exercise->youtube_id : '' }}">
    </div>
    <div class="form-group">
        <label>{{ trans('strings.theContent') }}</label>
        <textarea name="text" id="exercise-editor">
            {!! isset($exercise) ? $exercise->text : '' !!}
        </textarea>
    </div>
    <div class="form-group">
        <label> {{ trans('strings.theSolution') }} </label>
        <textarea name="solution" id="solution-editor">
            {!! isset($exercise) ? $exercise->solution : '' !!}
        </textarea>
    </div>
    <div class="form-group checkbox">
        <label class="col-sm-12"> {{ trans('strings.difficulty') }} </label>
        <div class="row">
            <div class="col-sm-4 col-lg-3">
                <input type="radio"
                       id="easy-checkbox"
                       class="flat-red"
                       name="difficulty"
                       value="easy"
                       @if (isset($exercise) && $exercise->difficulty == 'easy') checked @endif>
                <label for="easy-checkbox"> {{ trans('strings.easy') }} </label>
            </div>
            <div class="col-sm-4 col-lg-3">
                <input type="radio"
                       id="medium-checkbox"
                       class="flat-red"
                       name="difficulty"
                       value="medium"
                       @if (isset($exercise) && $exercise->difficulty == 'medium') checked @endif>
                <label for="medium-checkbox"> {{ trans('strings.medium') }} </label>
            </div>
            <div class="col-sm-4 col-lg-3">
                <input type="radio"
                       id="hard-checkbox"
                       class="flat-red"
                       name="difficulty"
                       value="hard"
                       @if (isset($exercise) && $exercise->difficulty == 'hard') checked @endif>
                <label for="hard-checkbox"> {{ trans('strings.hard') }} </label>
            </div>
        </div>
    </div>
</div>

{{-- Footer--}}
<div class="box-footer">
    <div class="pull-right">
        <a href="{{ URL::previous() }}"
           class="btn btn-danger">
            {{ trans('strings.cancel')  }}
            &nbsp;
            <i class="fa fa-ban"></i>
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-check"></i>
            {{ trans('strings.submit') }}
        </button>
    </div>
</div>
{!! Form::close() !!}


@section('scripts')
    <script>
        $(function(){
            var options = {
                language: 'ar',
                contentsLangDirection: 'rtl',
                extraAllowedContent: 'iframe[*]',
                uploadUrl: '/img_upload?_token={{csrf_token()}}'
            };

            options.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';

            CKEDITOR.replace('exercise-editor', options);
            CKEDITOR.replace('solution-editor', options);
        });
    </script>
@endsection