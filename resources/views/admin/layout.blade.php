<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/jquery.dataTables_v1.10.12.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <title>@yield('title')</title>
</head>
<body>
<header>
    @include('admin/partials/nav')
</header>
<div style="margin-top: 70px;">
    @yield('main_body')
</div>


<script type="text/javascript" src="/js/admin_app.js"></script>
<script type="text/javascript" src="/js/app.js"></script>

@yield('script')

</body>
</html>
