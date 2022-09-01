<div class="box box-info">

    <div class="box-header with-border">
        <h3 class="box-title"> @yield('form-title') </h3>
    </div>
    <!-- /.box-header -->

    <!-- form start -->
    {!!
        Form::open([
            'url' => $url,
            'method' => isset($method) ? $method : 'POST',
            'class' => 'form-horizontal',
        ])
     !!}

    <div class="box-body">
        @yield('content')
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">
            {{ trans('strings.ok') }}
            <i class="fa fa-check"></i> &nbsp;
        </button>
    </div>
    {!! Form::close() !!}
</div>