@extends('layouts.app')

@section('title', 'Delegaciones')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Delegaciones │
                    <a href="{{route('crear.delegacion')}}" type="button" class="btn btn-success">Crear nuevo</a>
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
                                    <th scope="col">DELEGACIONES</th>
                                    <th scope="col">SEDE</th>
                                    <th scope="col">NIVEL</th>
                                    <th scope="col">REGIÓN</th>
                                    <th scope="col">INFORMACIÓN</th>
                                </tr>
                            </thead>            
                            <tbody>
                                @foreach($delegaciones as $key => $delegacion)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $delegacion->nomenclatura->nomenclatura }}{{ $delegacion->numero }} </td>
                                        <td>{{ $delegacion->sede }} </td>
                                        <td>{{ $delegacion->nivel->nivel_educativo }} </td>
                                        <td>{{ $delegacion->region->nombre}} - {{$delegacion->region->sede}} </td>
                                        <td>
                                            <a href="{{ route('mostrar.delegacion',[$delegacion->slug])}}" type="button" class="btn btn-primary btn-sm">Ver</a>
                                            <a href="{{ route('editar.delegacion',[$delegacion->slug]) }}" type="button" class="btn btn-secondary btn-sm">Editar</a>
                                            <form action="{{ route('eliminar.delegacion',[$delegacion->slug]) }}" method="post" style="display:inline">
                                                @csrf                                
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                            </form>                                                                                       
                                        </td>                           
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $delegaciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection