@extends('layout')
@section('main_body')
    <form name="login_form" method="POST" action="{{url('login')}}">
        @csrf
        <label for="email">Email</label><br>
        <input type="text" name="email" value="{{old('email')}}"><br>
        <label for="password">Пароль</label><br>
        <input type="password" name="password" value="{{old('password')}}"><br>
        <label for="remember_user">запомнить меня</label>
        <input type="checkbox" name="remember_user"><br>
        <input type="submit" value="send">
    </form>
    @include('errors/list')
@stop
