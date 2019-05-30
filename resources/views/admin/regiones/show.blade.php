@extends('layouts.app')
@section('title', 'Region │ Mostrar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">IMÁGEN</div>

                <div class="card-body">
                    <center><img width="278px" class="img-thumbnail" src="{{Storage::url($region->photo_extension)}}" alt=""></center>
                </div>
            </div>        
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $region->nombre }} {{ $region->sede }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">NOMBRE</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" placeholder="{{ $region->nombre }}" readonly>
                        </div>                       
                    </div>

                    <div class="form-group row">
                        <label for="sede" class="col-md-4 col-form-label text-md-right">SEDE</label>
                        <div class="col-md-6">
                            <input id="sede" type="text" class="form-control{{ $errors->has('sede') ? ' is-invalid' : '' }}" name="sede" placeholder="{{ $region->sede }}" readonly>
                        </div>                       
                    </div>

                    <div class="form-group row">
                        <label for="coordinador" class="col-md-4 col-form-label text-md-right">COORDINADOR</label>
                        <div class="col-md-6">
                            <input id="coordinador" type="text" class="form-control{{ $errors->has('coordinador') ? ' is-invalid' : '' }}" name="coordinador" placeholder="{{ $region->coordinador }}" readonly>
                        </div>                       
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">EMAIL</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ $region->email }}" readonly>
                        </div>                       
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">TELEFONO</label>
                        <div class="col-md-6">
                            <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" placeholder="{{ $region->telefono }}" readonly>
                        </div>                       
                    </div>

                    <div class="form-group row">

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <a href="{{route('regiones')}}" class="btn btn-primary" >REGRESAR</a> │
                            <a href="{{route('editar.regiones',[$region->slug])}}" class="btn btn-success" >EDITAR</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   INFORMACIÓN DELEGACIONAL 
                </div>
                <div class="card-body">
                    CANTIDAD DE DELEGACIONES <strong>{{$count_deleg}}</strong>
                    <hr>

                    <div class="row">
                        <div class="col-md-6" style="border: 1px solid red">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">DELEGACIÓN</th>
                                        <th scope="col">SEDE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($delegaciones as $key => $delegacion)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$delegacion->nomenclatura->nomenclatura}} {{$delegacion->numero}}</td>
                                            <td>{{$delegacion->sede}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $delegaciones->links() }}
                        </div>
                        <div class="col-md-3" style="border: 1px solid red">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">NOMENCLATURAS</th>
                                        <th scope="col">CANTIDAD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nomenclaturas as $nom)
                                    <tr>
                                        <th scope="row" class="text-right">{{$nom->nomenclatura}}</th>
                                        <td>25</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection
