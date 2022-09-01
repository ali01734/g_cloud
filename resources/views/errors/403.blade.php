@extends('errors.base')
@section('error_title')
    لا يسمح لك بالدخول
@endsection
@section('error_message')
<img src="/images/stop.svg" style="width : 50px;height : 50px"/>
    لا يسمح لك بالدخول
<a href="/" class="button text-center" style="background-color : inherit;border :2px solid #333;color : #333;display : block;
margin : 30px auto;width : 130px">
ارشدني
</a>
@endsection