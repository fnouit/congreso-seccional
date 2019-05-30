@extends('layouts.app')
@section('title', 'Region │ Editar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $region->nombre }} {{ $region->sede }} │ EDITAR</div>



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
                    <form action="{{route('actualizar.regiones',[$region->slug])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">NOMBRE</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $region->nombre }}" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="sede" class="col-md-4 col-form-label text-md-right">SEDE</label>
                            <div class="col-md-6">
                                <input id="sede" type="text" class="form-control{{ $errors->has('sede') ? ' is-invalid' : '' }}" name="sede" value="{{ $region->sede }}" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="coordinador" class="col-md-4 col-form-label text-md-right">COORDINADOR</label>
                            <div class="col-md-6">
                                <input id="coordinador" type="text" class="form-control{{ $errors->has('coordinador') ? ' is-invalid' : '' }}" name="coordinador" value="{{ $region->coordinador }}" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">EMAIL</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $region->email }}" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">TELEFONO</label>
                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $region->telefono }}" >
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
                                <a href="{{URL::previous()}}" class="btn btn-primary" >REGRESAR</a> │
                                <button type="submit" class="btn btn-danger">ACTUALIZAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
