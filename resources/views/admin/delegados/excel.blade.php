<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Excel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Excel</title>
  </head>
  <body>
    <h1 class="mt-5">Exportar Delegados</h1>
    
      <div class="row">
          <table class="table">
              <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">REGION</th>
                      <th scope="col">DELGACION</th>
                      <th scope="col">SEDE</th>
                      <th scope="col">NOMBRE</th>
                      <th scope="col">AP PATERNO</th>
                      <th scope="col">AP MATERNO</th>
                      <th scope="col">GENERO</th>
                      <th scope="col">RFC</th>
                      <th scope="col">EMAIL</th>
                      <th scope="col">GRADO DE ESTUDIO</th>
                      <th scope="col">ESTADO CIVIL</th>
                      <th scope="col">TELEFONO</th>
                      <th scope="col">FACEBOOK</th>
                      <th scope="col">TWITTER</th>
                      <th scope="col">RUTA DE IMAGEN</th>
                      <th scope="col">USUARIO</th>
                  </tr>
              </thead>            
              <tbody>
                  @foreach($delegados as $key => $delegado)
                      <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$delegado->delegacion->region->nombre}}</td>
                          <td>{{$delegado->delegacion->nomenclatura->nomenclatura}}{{$delegado->delegacion->numero}}</td>
                          <td>{{$delegado->delegacion->sede}}</td>
                          <td>{{$delegado->nombre}}</td>
                          <td>{{$delegado->ap_paterno}}</td>
                          <td>{{$delegado->ap_materno}}</td>
                          <td>{{$delegado->genero->genero}}</td>
                          <td>{{$delegado->rfc}}</td>
                          <td>{{$delegado->email}}</td>
                          <td>{{$delegado->estudio->maximo_estudio}}</td>
                          <td>{{$delegado->situacion->estado_civil}}</td>
                          <td>{{$delegado->telefono}}</td>
                          <td>{{$delegado->facebook}}</td>
                          <td>{{$delegado->twitter}}</td>
                          <td>{{$delegado->imagen}}</td>
                          <td>{{$delegado->user->name}}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>      


  </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
