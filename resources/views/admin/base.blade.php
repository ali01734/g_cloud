<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport">
    <link rel="stylesheet"
          href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet"
          href="/dist/css/skins/skin-blue.min.css">

    <link rel="stylesheet"
          href="/css/admin.css">
    <link rel="stylesheet"
          href="/public/bower_components/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet"
          href="/plugins/select2/select2.min.css">


    <link rel="stylesheet"
          href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel="stylesheet"
          href="/plugins/iCheck/square/green.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{ route('admin.index') }}">
            <span class="logo">
            <span class="logo-mini">
                <div>
                    <img src="/images/leaf-logo.svg" alt="Logo" style="max-width: 100%; height: 40px">
                </div>
            </span>
            <span class="logo-lg">
                <b>
                    <div>
                        <img src="/images/small-logo.svg" alt="Logo" style="max-width: 100%; max-height: 100%">
                    </div>
                </b>
            </span>
            </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top"
             role="navigation">
            <a href="#"
               class="sidebar-toggle"
               data-toggle="offcanvas"
               role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            @include('admin.partials.navbar-right-menu')
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        @include('admin.partials.sidebar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('content-header-title')
                <small> @yield('content-header-title-small') </small>
            </h1>

            {{-- Breadcrumbs --}}
            @yield('bread-crumbs')
        </section>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> @yield('title') </h1>
        </section>

        <section class="content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="flush-message-container">
                @if(Session::has('error'))
                    <div class="alert alert-danger" style="text-align: right">
                        {{ trans('strings.' . Session::get('error')) }}
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success" style="text-align: right">
                        {{ trans('strings.' . Session::get('success')) }}
                        &nbsp;
                        <i class="fa fa-check"></i>
                    </div>
                @endif

            </section>


            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs"> @yield('footer-right') </div>
        <strong> @yield('footer-left') </strong>
    </footer>

    @include('admin.partials.control-side-bar')
</div>


<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/dist/js/app.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/public/bower_components/sweetalert/dist/sweetalert.min.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    $('select.select2').select2();
</script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>

<script src="/js/prevent.js"></script>
<script>
    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>
@yield('scripts')




</body>
</html>