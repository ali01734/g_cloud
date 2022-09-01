{!!
    Form::open([
        'url' => $url,
        'method' => $method,
        'enctype' => 'multipart/form-data',
    ])
!!}

<div class="box">
    <div class="box-header">
        <strong class="text-blue">
            {{ $formTitle }}
        </strong>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>
                {{ trans('strings.name') }}
            </label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ isset($lesson) ? $lesson->name : '' }}"
                   required>
        </div>
        
        <div class="form-group">
            <label> Youtube ID</label>
            <input type="text"
                   name="youtube_id"
                   class="form-control"
                   value="{{ isset($lesson) ? $lesson->youtube_id : '' }}">
        </div>

        <div class="form-group">
            <label>
                {{ trans('strings.theContent') }}
            </label>

            <textarea name="text"
                      class="form-control"
                      id="lesson-editor">
                {!! isset($lesson) ? $lesson->text : '' !!}
            </textarea>
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit"
                    class="btn btn-primary">
                {{ trans('strings.ok') }}
                <i class="fa fa-check"></i>
            </button>
        </div>
    </div>
</div>

<script>
    $(function(){
        var options = {
            language: 'ar',
            contentsLangDirection: 'rtl',
            extraAllowedContent: 'iframe[*]',
            uploadUrl: '/img_upload?_token={{csrf_token()}}'
        };

        CKEDITOR.replace('lesson-editor', options);
    });
</script>

{!! Form::close() !!}