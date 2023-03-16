@extends('admin/layout')
@section('title')
    {{$worker->name}}
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>ФИО сотрудника: {{$worker->name}}</h3>
                <div><span class="fw-bold">Телефон:</span> {{$worker->phone}}</div>
                <div><span class="fw-bold">Email:</span> {{$worker->email}}</div>
            </div>
        </div>
    </div>
    <div class="container">
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
