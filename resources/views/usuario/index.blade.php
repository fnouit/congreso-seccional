@extends('layouts.app')

@section('title', 'Delegados')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col"><strong><h4>Delegados</h4></strong></div>
                        <div class="col">
                            <div class="float-right"><a href="{{route('new.delegado')}}" type="button" class="btn btn-success">Nuevo Delegado</a></div>
                        </div>
                    </div>                
                </div>
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
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">DELGACION</th>
                                    <th scope="col">REGION</th>
                                </tr>
                            </thead>            
                            <tbody>
                                @foreach($delegados as $key => $delegado)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$delegado->ap_paterno}} {{$delegado->ap_materno}} {{$delegado->nombre}}</td>
                                        <td>{{$delegado->delegacion->nomenclatura->nomenclatura}}{{$delegado->delegacion->numero}} - {{$delegado->delegacion->sede}}</td>
                                        <td>{{$delegado->delegacion->region->nombre}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <center> &copy SNTE Sección 56 - 2020 </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection