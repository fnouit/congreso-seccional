<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
  <meta name="author" content="Incanatoit.com">
  <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
  <meta name="csrf-token" content="{‌{ csrf_token() }}">

  <title>Sistema Ventas - IncanatoIT</title>

  <link href="{{asset('/css/template.css')}}" rel="stylesheet">

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    @yield('content')
  </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/template.js')}}"></script>

</body>
</html>