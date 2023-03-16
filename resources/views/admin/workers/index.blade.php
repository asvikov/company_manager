@extends('admin/layout')
@section('title')
    Список работников
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="float-start">Работники</h3>
                    <a href="/admin/workers/create" class="btn btn-success float-end">добавить работника</a>
                </div>
                <hr class="clear-b">
                <table id="workers" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Компания</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <div class="popup-fade">
        <div class="popup">
            <div class="popup-close">
                <button id="popup-delete" class="btn-sm btn-danger">Удалить</button>
                <button id="popup-close" class="btn-sm">Отмена</button>
            </div>
            <p>Вы действительно хотите удалить работника?</p>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            let options = {
                data_items : {!! $workers_json !!},
                csrf: '{!! @csrf_token() !!}',
                columns : [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'company',
                    'action'
                ],
                route : 'workers'
            };

            let admin_index_list = new AdminIndexList(options);
            admin_index_list.dataTable();
        });
    </script>
@stop
