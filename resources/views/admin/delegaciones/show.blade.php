@extends('layouts.app')

@section('title', 'Delegacion │ Mostrar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Delegacion {{ $delegacion->nomenclatura->nomenclatura }}{{ $delegacion->numero }}</div>
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
                    <div class="form-group ">
                        <label for="delegacion">DELEGACION</label>
                        <input  type="text" 
                                class="form-control " 
                                placeholder="{{ $delegacion->nomenclatura->nomenclatura }}{{ $delegacion->numero }}" readonly>       
                    </div>
                    <div class="form-group ">
                        <label for="sede">SEDE</label>
                        <input  type="text" 
                                class="form-control" 
                                placeholder="{{ $delegacion->sede }}" readonly>       
                    </div>
                    <div class="form-group ">
                        <label for="nivel_educativo">NIVEL EDUCATIVO</label>
                        <input  type="text" 
                                class="form-control" 
                                placeholder="{{ $delegacion->nivel->nivel_educativo }}" readonly>       
                    </div>
                    <div class="form-group ">
                        <label for="region">REGION</label>
                        <input  type="text" 
                                class="form-control" 
                                placeholder="{{ $delegacion->region->nombre}} - {{$delegacion->region->sede}}" readonly>       
                    </div><hr>
                    <div class="row ">
                        <div class="form-group col-md-6 col-md-offset-3 ">
                            <a href="{{ URL::previous() }}" type="button"  class="btn btn-primary btn-xl btn-block">Atras</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




                            