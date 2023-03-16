@extends('admin/layout')
@section('title')
    {{$company->name}}
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Название компании: {{$company->name}}</h3>
                <img src="{{$company->logo_url ? asset($company->logo_url) : asset('storage/company_images/blank_l.jpg')}}" class="company_logo img-thumbnail">
                <div id="YMapsID"></div>
                <div><span class="fw-bold">Адрес компании:</span> {{$company->address}}</div>
                <div><span class="fw-bold">Email:</span> {{$company->email}}</div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Список сотрудников:</h4>
                <hr>
                <table id="workers" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=c093f496-4f70-421a-b1fd-dc9372183b19&lang=ru_RU" type="text/javascript"></script>
    <script>
        ymaps.ready(init);
        function init(){
            let script_admin_company = new ScriptAdminCompany({
                company_id : {{$company->id}},
                company_address : "{{$company->address}}",
                @if($coordinate)
                coordinate_latitude : {{$coordinate->latitude}},
                coordinate_longitude : {{$coordinate->longitude}},
                @endif
                data_workers : {!! $workers_in_company !!}
            });
            script_admin_company.dataTable();
            script_admin_company.logoImg();
            script_admin_company.yaMapCompany();
        }
    </script>
@stop
