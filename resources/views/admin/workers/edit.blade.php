@extends('admin/layout')
@section('title')
    {{$worker->name}}
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('errors/list')
                <form action="/admin/workers/{{$worker->id}}" method="post" id="form_one" class="">
                    @method($method)
                    @csrf
                    <div>
                        <label for="name" class="form-text text-muted">ФИО сотрудника:</label>
                        <input type="text" value="{{$worker->name ? $worker->name : old('name')}}" name="name" class="form-control">
                    </div>
                    <div>
                        <label for="email" class="form-text text-muted">Ведите email:</label>
                        <input type="text" name="email" value="{{$worker->email ? $worker->email : old('email')}}" class="form-control">
                    </div>
                    <div>
                        <label for="address" class="form-text text-muted">Ведите телефон:</label>
                        <input type="text" name="phone" value="{{$worker->phone ? $worker->phone : old('phone')}}" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-sm-3">
        <div class="row">
            <div class="col-md-12">
                <h4>Компании в которых числится сотрудник:</h4>
                <hr>
                <table id="companies" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pic</th>
                        <th>Название</th>
                        <th>Email</th>
                        <th>Адрес</th>
                    </tr>
                    </thead>
                </table>
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
@section('script')
    <script>
        $(document).ready(function () {

            let options = {
                data_items : {!! $companies !!},
                columns : [
                    'id',
                    'logo_url',
                    'name',
                    'email',
                    'address'
                ],
                route : 'companies'
            };

            let admin_index_list = new AdminIndexList(options);
            admin_index_list.dataTable();
        });
    </script>
@stop
