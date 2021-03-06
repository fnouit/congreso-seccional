@extends('layouts.app')
@section('title', 'Delegado │ Nueva')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Nuevo Delegado</strong></div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">¡Parece que hay un erro!</h4><hr>
                        <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </p>                            
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>     
                @endif
                <div class="card-body">


                    <form action="{{route('almacena.delegado')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <h5 class="text-uppercase text-secondary mb-3" >Datos Laborales</h5>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label for="region">REGIÓN</label>
                                    <select class="custom-select form-control" name="region" id="region" >
                                        <option disabled selected>SELECCIONA LA REGIÓN</option>
                                        @foreach ($regiones as $key => $region)
                                            <option value="{{$region->id}}">{{$key+1}} - {{$region->nombre}}&nbsp &nbsp{{$region->sede}}</option>
                                        @endforeach
                                    </select>                    
                                </div>
                                <div class="col-sm-8 form-group">
                                    <label for="delegaciones">DELEGACIONES</label>
                                    <select class="custom-select form-control" name="delegaciones" id="delegaciones" >

                                    </select>                    
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5 class="text-uppercase text-secondary mb-3" >Datos Personales</h5>
                            <div class="row">
                                <div class="col-sm-6 form-group">      
                                    <label for="nombre">INGRESA TÚ NOMBRE</label>          
                                    <input id="nombre" type="text" name="nombre" class="form-control gui-input" style='text-transform:uppercase;' placeholder="*" value="{{ old('nombre')}}" >
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="apellido_paterno">PRIMER APELLIDO</label>          
                                    <input id="apellido_paterno" type="text" name="apellido_paterno" class="form-control gui-input " style='text-transform:uppercase' placeholder="*" value="{{ old('apellido_paterno')}}">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="apellido_materno">SEGUNDO APELLIDO</label>          
                                    <input id="apellido_materno" type="text" name="apellido_materno" class="form-control gui-input" style='text-transform:uppercase' value="{{ old('apellido_materno')}}" >
                                </div>
                            </div>                           
                        
                            <div class="row">
                                <div class="col-sm-3  form-group">
                                    <label for="apellido_materno">CORREO</label>          
                                    <input id="correo" type="email" name="correo" class="form-control" placeholder="*" value="{{old('correo')}}"  >
                                </div>
                                <div class="col-sm-3  form-group">
                                    <label for="rfc">INGRESA TÚ RFC</label>
                                    <input id="rfc" type="text" name="rfc" class="form-control" style='text-transform:uppercase' placeholder="*" value="{{old('rfc')}}" >
                                </div>
                                <div class="col-sm-3  form-group">
                                    <label for="genero">GENERO</label>          
                                    <select id="genero" name="genero" class="form-control">                            
                                        <option></option>
                                        @foreach ($generos as $key => $genero)
                                            <option value="{{$genero->id}}"> {{$key+1}} - {{$genero->genero}} </option>                    
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3  form-group">
                                    <label for="situacion">ESTADO CIVÍL</label>          
                                    <select id="situacion" name="situacion" class="form-control">                            
                                        <option></option>                    
                                        @foreach ($situaciones as $key => $situacion)
                                            <option value="{{$situacion->id}}"> {{$key+1}} - {{$situacion->estado_civil}} </option>                    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-6  form-group">
                                    <label for="telefono">¿TÚ TELÉFONO ES?</label>
                                    <input id="telefono" type="tel" name="telefono" class="form-control" telefono value="{{old('telefono')}}">
                                </div>
                                <div class="col-sm-6  form-group">
                                    <label for="estudio">¿CUAL ES SU ÚLTIMO GRADO DE ESTUDIOS?</label>
                                    <select id="estudio" name="estudio" class="form-control">                            
                                        <option></option>                    
                                        @foreach ($estudios as $key => $estudio)
                                            <option value="{{$estudio->id}}"> {{$key+1}} - {{$estudio->maximo_estudio}} </option>                    
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        
                            <div class="row">
                                <div class="col-sm-6  form-group">
                                    <label for="facebook">¿CUÁL ES TU FACEBOOK?</label>
                                    <input type="text" id="facebook" name="facebook" class="form-control" value="{{old('facebook')}}">       
                                </div>
                                <div class="col-sm-6  form-group">
                                    <label for="twitter">¿CUÁL ES TU TWITTER?</label>
                                    <input type="text" id="twitter" name="twitter" class="form-control" value="{{old('twitter')}}">
                                </div>                      
                            </div> 
                        </div>

                        <div class="mb-3">
                            <h5 class="text-uppercase text-secondary mb-3" >SELECCIONA FOTO</h5>
                            <div class="row">
                                <div class="col-sm-12  form-group">
                                    <input type="file" class="form-control-file form-control" name="foto" id="foto" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Por favor, cargue un archivo de imagen válido. El tamaño de la imagen no debe ser superior a 2MB.</small>
                                </div>
                              
                            </div>                     
                        </div>

                        <div class="mb-3">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12  form-group pt20">
                                    <center><button type="submit" data-btntext-sending="Sending..." class="button btn btn-primary">Regístrate</button></center>
                                </div>
                            </div>                    
                        </div>
                    </form>

                </div>
                <div class="card-footer text-muted">

                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">

    $(document).ready(function (){
        $("#region").change(function(){
            var region_id = $(this).val();
            
            $.get('/regiones/'+region_id+'/delegaciones',function(data){
                $('#delegaciones').empty();
                $('#delegaciones').append('<option disabled selected>SELECCIONA DELEGACIÓN</option>');           
                for (var i = 0; i < data.length; ++i)
                $('#delegaciones').append('<option value="'+ data[i].id +'">' + data[i].slug + " - " +data[i].sede +'</option>');

                return;
            });

        });
    });

</script>

@endsection