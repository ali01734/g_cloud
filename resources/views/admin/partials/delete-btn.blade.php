{!!
    Form::open([
        'url' => $url,
        'method' => 'delete'
    ])
!!}
    <button type="submit"
            class="link-button"
            data-prevent>
        <i class="fa fa-trash text-red"></i>
    </button>
{!! Form::close() !!}