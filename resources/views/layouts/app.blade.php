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
        // TODO: dataLayer
    </script>
    @section('js')
        <script src="{{ asset('page_language/page_translate.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    @show
</head>
<body>
    <!-- google tag -->

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
