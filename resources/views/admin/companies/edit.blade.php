@extends('admin/layout')
@section('title')
    {{$company->name}}
@stop
@section('main_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('errors/list')
                <form action="/admin/companies/{{$company->id}}" method="post" enctype="multipart/form-data" id="form_one" class="">
                    @method($method)
                    @csrf
                    <div>
                        <label for="name" class="form-text text-muted">Название компании:</label>
                        <input type="text" value="{{$company->name ? $company->name : old('name')}}" name="name" class="form-control">
                    </div>
                    <div class="custom-file">
                        <label for="logo_url" class="custom-file-label">Логотип компании</label>
                        <img src="{{asset($company->logo_url ? $company->logo_url : 'storage/company_images/blank_l.jpg')}}" id="company_logo_img" class="company_logo d-md-block img-thumbnail">
                        <input type="file" accept="image" value="{{$company->logo_url}}" name="logo_url" id="company_logo_input" class="form-control custom-file-input">
                    </div>
                    <div>
                        <div id="YMapsID"></div>
                    </div>
                    <div>
                        <label for="address" class="form-text text-muted">Ведите адрес:</label>
                        <input type="text" name="address" id="company_address" value="{{$company->address ? $company->address : old('address')}}" class="form-control">
                        <input type="text" id="latitude_inp" name="latitude" value="{{$coordinate ? $coordinate->latitude : old('latitude')}}" hidden>
                        <input type="text" id="longitude_inp" name="longitude" value="{{$coordinate ? $coordinate->longitude : old('longitude')}}" hidden>
                    </div>
                    <div>
                        <label for="email" class="form-text text-muted">Ведите email:</label>
                        <input type="text" name="email" value="{{$company->email ? $company->email : old('email')}}" class="form-control">
                    </div>
                    <input type="text" name="workers_in_company" id="workers_in_company" value="" hidden>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-sm-3">
        <div class="row">
            <div class="col-md-12">
                <h4>Список сотрудников:</h4>
                <div>
                    <input list="add_worker" id="workers_input" placeholder="Выберите сотрудника чтобы добавить" value="" class="w-50">
                    <datalist id="add_worker">
                        @foreach($workers as $worker)
                            <option data-id="{{$worker->id}}" data-email="{{$worker->email}}" data-phone="{{$worker->phone}}">{{$worker->name}}</option>
                        @endforeach
                    </datalist>
                    <button id="add_worker_but">Добавить</button>
                </div>
                <hr>
                <table id="workers" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Action</th>
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
                <a href="/admin/companies" class="btn btn-primary">Отменить</a>
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
                company_id : {{$company->id ? $company->id : 0}},
                company_address : "{{$company->address}}",
                @if($coordinate)
                    coordinate_latitude : {{$coordinate->latitude}},
                    coordinate_longitude : {{$coordinate->longitude}},
                @endif
                data_table_butt_delete : true,
                map_allow_edit : true,
                @if($workers_in_company)
                    data_workers : {!! $workers_in_company !!}
                @endif
            });
            script_admin_company.dataTable();
            script_admin_company.logoImg();
            script_admin_company.yaMapCompany();
        }
    </script>
@stop
