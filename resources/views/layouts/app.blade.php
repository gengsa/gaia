<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('metaLabels')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0"/>
<!--         <meta name="google-site-verification" content="a9ctL6JQGqpgleU9jwBJFWOhj2KMnqAw5bhRC7OleoI"/> -->
        
    @show

    <link rel="icon" href="favicon.ico">

    <title>@section('title') {{ config('app.name', 'Gaia') }} @show</title>
    <meta name="keywords" content="@section('keywords') {{ config('app.name', 'Gaia') }} @show">
    <meta name="description" content="@section('description') {{ config('app.name', 'Gaia') }} @show">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TODO: maybe fonts show set in css block -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <!-- Styles -->
    @section('css')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @show

    <!-- Scripts -->
    <script type="text/javascript">
        // TODO: web data
        var webData = {
            language: 'en', // TODO
            staticDomain: '', // TODO
            currentRoute: '{{ request()->route()->getName() }}',
        };
        // TODO: dataLayer
    </script>
    @section('js')
        <script src="{{ asset('storage/page_translate.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    @show
</head>
<body>
    <!-- google tag -->

    <div id="app">
        @include('layouts._header')
        <main>
            @yield('content')
        </main>
        @include('layouts._footer')
    </div>
</body>
</html>
