@extends('admin.base')

@section('content-header-title')
    {{ trans('strings.nataalam') }}
@endsection

@section('content')
    <div class="box col-lg-6">
        <div class="box-header">
            <h3 class="box-title"> {{ trans('strings.welcome') }}</h3>
        </div>
        <div class="box-body">
            @foreach ($sideBarLinks as $link)
                <a class="btn btn-app"
                   href="{{ $link['href'] }}">
                    @if (isset($link['count']))
                        <span class="badge bg-green">
                            {{ $link['count'] }}
                        </span>
                    @endif
                    <i class="fa {{ $link['fa'] }}"></i>
                    {{ $link['text'] }}
                </a>
            @endforeach
        </div>
    </div>
@endsection