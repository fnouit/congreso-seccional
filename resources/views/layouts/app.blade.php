<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Sistema')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stacktable.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('login') }}">
                    {{ __('Congreso Seccional 2020') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @guest
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @if(Auth::user()->admin)
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="navbar-brand" href="#">{{ __('Usuarios') }}</a></li>
                            <li class="nav-item"><a class="navbar-brand" href="{{ url('/admin/regiones') }}">{{ __('Regiones') }}</a></li>
                            <li class="nav-item"><a class="navbar-brand" href="{{ url('/admin/niveles') }}">{{ __('Niveles') }}</a></li>
                            <li class="nav-item"><a class="navbar-brand" href="{{ url('/admin/nomenclaturas') }}">{{ __('Nomenclaturas') }}</a></li>
                            <li class="nav-item"><a class="navbar-brand" href="{{ url('/admin/delegaciones') }}">{{ __('Delegaciones') }}</a></li>
                            <li class="nav-item"><a class="navbar-brand" href="{{ url('/admin/delegados') }}">{{ __('Delegados') }}</a></li>
                        </ul>
                    @else
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                    @endif

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </nav>

        <main class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">        
                    @include('layouts.flash-message')
                <div>
            </div>
            
            @yield('content')
        </main>
    </div>
</body>


@yield('script')
</html>
