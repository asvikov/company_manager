@extends('layout')
@section('title')
    Приложение управления компаниями
@stop
@section('main_body')
    <div class="text-center pt-lg-5">
        <div class="pt-lg-3"><a href="{{url('/admin/companies')}}" class="btn btn-primary">перейти в раздел управления компаниями</a></div>
        <div class="pt-lg-3"><a href="{{url('/admin/workers')}}" class="btn btn-primary">перейти в раздел управления сотрудниками</a></div>
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="pt-lg-3"><a href="{{url('/logout')}}" class="btn btn-primary">выйти</a></div>
        @else
            <div class="pt-lg-3"><a href="{{url('/login')}}" class="btn btn-primary">войти</a></div>
        @endif
    </div>

@stop
