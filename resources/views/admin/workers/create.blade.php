@extends('admin/layout')
@section('title')
    Создать нового пользователя
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('errors/list')
                <form action="/admin/workers/" method="post" id="form_one" class="">
                    @method('POST')
                    @csrf
                    <div>
                        <label for="name" class="form-text text-muted">ФИО сотрудника:</label>
                        <input type="text" value="" name="name" class="form-control">
                    </div>
                    <div>
                        <label for="email" class="form-text text-muted">Ведите email:</label>
                        <input type="text" name="email" value="" class="form-control">
                    </div>
                    <div>
                        <label for="address" class="form-text text-muted">Ведите телефон:</label>
                        <input type="text" name="phone" value="" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-md-end">
                <button form="form_one" type="submit" class="btn btn-success">Сохранить</button>
                <a href="/admin/workers" class="btn btn-primary">Отменить</a>
            </div>
        </div>
    </div>
@stop
