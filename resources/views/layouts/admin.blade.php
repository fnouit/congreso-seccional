
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="{{asset('/img/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Icons -->
    <link href="{{asset('/css/template.css')}}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Escritorio</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Configuraciones</a>
                </li>
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <li>
                        <img src="{{asset('/img/avatars/6.jpg')}}" class="img-avatar" alt="admin@bootstrapmaster.com">                        
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#"> <strong>{{ Auth::user()->name }}</strong></a>                     
                </li>
                <li>|</li>
                <li class="nav-item px-3">
                    <a href="{{ route('logout') }}"
                        class="nav-link" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i>
                        {{ __('Cerrar sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </li>                
            </ul>

        </header>

        <div class="app-body">
            @include('layouts.sidebar')

            <!-- Contenido Principal -->
            @yield('content')
            <!-- /Fin del contenido principal -->
        </div>
    </div>

    <footer class="app-footer">
        <span><a href="http://www.snte.org.mx/seccion56">Intranet SNTE - Sección 56</a> &copy; 2017</span>
        <span class="ml-auto">Desarrollado por <strong>Innovación Tecnológica - Área de Sistemas</strong></span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/template.js')}}"></script>
</body>

</html>