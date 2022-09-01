{!!
    Form::open([
        'url' => $url,
        'method' => 'patch'
    ])
!!}
<button type="submit"
        class="link-button"
        title="{{ $title }}"
        data-prevent>
    <i class="fa fa-unlock text-green"></i>
</button>
{!! Form::close() !!}