@extends('layouts.app')

@section('title', 'Nomenclaturas')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nomenclaturas Delegacionales
                    <a href="{{route('crear.nomenclatura')}}" class="btn btn-success">Crear nuevo</a>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">nomenclatura</th>
                                <th scope="col">CONFIGURACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nomenclaturas as $key => $nomenclatura)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td> {{$nomenclatura->nomenclatura}} </td>
                                <td>

                                <div class="btn-group">
                                    <a href="{{route('mostrar.nomenclatura',$nomenclatura->slug)}}" class="btn btn-sm btn-outline-secondary">Ver</a> 
                                    <a href="{{route('editar.nomenclatura',[$nomenclatura->slug])}}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{route('eliminar.nomenclatura',[$nomenclatura->slug])}}" method="POST">
                                        @csrf                                
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-outline-secondary" type="submit">Eliminar</button>
                                    </form>
                                </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection