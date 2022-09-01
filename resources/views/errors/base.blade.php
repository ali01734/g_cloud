@extends('client.base')

@section('page_title')
    @yield('error_title')
@endsection

@section('content')
<section class="row error_content">
<figure class="column">
    <img src="/images/small-logo.svg" />
    <hr>
    <h2> @yield('error_message') </h2>
</figure>
</section>
@endsection