@extends('layouts.app')
@section('title', 'Nivel │ Mostrar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $nivel->nivel_educativo }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="nivel_educativo" class="col-md-4 col-form-label text-md-right">NIVEL EDUCATIVO</label>
                        <div class="col-md-6">
                            <input id="nivel_educativo" type="text" class="form-control{{ $errors->has('nivel_educativo') ? ' is-invalid' : '' }}" name="nivel_educativo" placeholder="{{ $nivel->nivel_educativo }}" readonly>
                        </div>                       
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <a href="{{route('ver.niveles')}}" class="btn btn-primary" >REGRESAR</a> │
                            <a href="{{route('editar.nivel',[$nivel->slug])}}" class="btn btn-success" >EDITAR</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection