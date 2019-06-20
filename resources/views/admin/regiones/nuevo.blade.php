@extends('layouts.app')
@section('title', 'Region │ Editar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">NUEVA</div>



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
                    <form action="{{url('/admin/regiones/registrar')}}" method="post" enctype="multipart/form-data">
                    @csrf                    
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">NOMBRE</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="sede" class="col-md-4 col-form-label text-md-right">SEDE</label>
                            <div class="col-md-6">
                                <input id="sede" type="text" class="form-control{{ $errors->has('sede') ? ' is-invalid' : '' }}" name="sede" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="coordinador" class="col-md-4 col-form-label text-md-right">COORDINADOR</label>
                            <div class="col-md-6">
                                <input id="coordinador" type="text" class="form-control{{ $errors->has('coordinador') ? ' is-invalid' : '' }}" name="coordinador" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">EMAIL</label>
                            <div class="col-md-6">
                                <input id="correo" type="text" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}" name="correo" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">TELEFONO</label>
                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">SLUG   </label>
                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">IMAGEN</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" name="photo" >
                            </div>                       
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-danger">NUEVA</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
