@extends('layouts.app')
@section('title', 'Nivel │ Mostrar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $nomenclatura->nomenclatura }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="nomenclatura" class="col-md-4 col-form-label text-md-right">NOMENCLATURA DELEGACIONAL</label>
                        <div class="col-md-6">
                            <input id="nomenclatura" type="text" class="form-control{{ $errors->has('nomenclatura') ? ' is-invalid' : '' }}" name="nomenclatura" placeholder="{{ $nomenclatura->nomenclatura }}" readonly>
                        </div>                       
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <a href="{{route('ver.nomenclaturas')}}" class="btn btn-primary" >REGRESAR</a> │
                            <a href="{{route('editar.nomenclatura',[$nomenclatura->slug])}}" class="btn btn-success" >EDITAR</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection