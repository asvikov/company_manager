<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/app.css" rel="stylesheet">

    <title>@yield('title')</title>
</head>
<body>
@yield('main_body')

<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
