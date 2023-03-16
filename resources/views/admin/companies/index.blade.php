@extends('admin.layout')
@section('title')
    Список компаний
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="float-start">Компании</h3>
                    <a href="/admin/companies/create" class="btn btn-success float-end">добавить компанию</a>
                </div>
                <hr class="clear-b">
                <table id="companies" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pic</th>
                        <th>Название</th>
                        <th>Email</th>
                        <th>Адрес</th>
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
            <p>Вы действительно хотите удалить компанию?</p>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            let options = {
                data_items : {!! $companies !!},
                csrf: '{!! @csrf_token() !!}',
                columns : [
                    'id',
                    'logo_url',
                    'name',
                    'email',
                    'address',
                    'action'
                ],
                route : 'companies'
            };

            let admin_index_list = new AdminIndexList(options);
            admin_index_list.dataTable();
        });
    </script>
@stop
