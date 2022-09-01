{!!
    Form::open([
        'url' => isset($url) ? $url : '',
        'method' => isset($method) ? $method : 'GET',
        'style' => 'display: inline-block'
    ])
!!}
    <button type="submit"
            name="{{ isset($name) ? $name : ''}}"
            class="link-button"
            title="{{ isset($title) ? $title : '' }}"
            @if (isset($prevent) and $prevent) data-prevent @endif>
        <i class="fa {{ $fa or 'fa-times' }} {{ $color or 'text-red' }}"></i>
    </button>
{!! Form::close() !!}