@extends('layouts.app')

@section('title', 'Delegaciones')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong><h4>Delegados</h4></strong></div>
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
                                    <th scope="col">RFC</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">INFORMACIÓN</th>
                                </tr>
                            </thead>            
                            <tbody>
                                @foreach($delegados as $key => $delegado)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$delegado->ap_paterno}} {{$delegado->ap_materno}} {{$delegado->nombre}}</td>
                                        <td>{{$delegado->delegacion->nomenclatura->nomenclatura}}{{$delegado->delegacion->numero}} - {{$delegado->delegacion->sede}}</td>
                                        <td>{{$delegado->delegacion->region->nombre}}</td>
                                        <td>{{$delegado->rfc}}</td>
                                        <td>{{$delegado->email}}</td>
                                        <td>
                                            <a href="{{route('mostrar.delegado',[$delegado->slug])}}" class="btn btn-sm btn-outline-info" >Ver</a>
                                            <a href="{{route('editar.delegado',[$delegado->slug])}}" class="btn btn-sm btn-outline-success" >Editar</a>
                                            <form action="{{route('eliminar.delegado',[$delegado->slug])}}" method="POST" style="display:inline">
                                                @csrf                                
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                            </form>                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Crear nuevo Delegado <a href="{{route('crear.delegado')}}" type="button" class="btn btn-success">Añadir</a> │
                    Exportar a excel <a href="{{url('exportar/excel')}}" type="button" class="btn btn-success">Exportar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection