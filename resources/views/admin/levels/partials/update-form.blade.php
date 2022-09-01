<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="{{ $id }}">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="text-blue">
                    <i class="fa {{ $fa }}"></i> &nbsp;
                    {{ $title }}
                </strong>
            </div>
            {!!
                Form::open([
                    'url' => $url,
                    'method' => $method,
                    'class' => 'form',
                ])
            !!}
            <div class="modal-body">
                <div class="form-group">
                    <label> {{ trans('strings.name') }} </label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ isset($value) ? $value : '' }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ trans('strings.cancel') }}
                    <i class="fa fa-ban"></i>
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ trans('strings.basic.ok') }}
                    <i class="fa fa-check"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>