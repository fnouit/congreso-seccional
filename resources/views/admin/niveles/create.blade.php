@extends('layouts.app')
@section('title', 'Nivel │ Nuveo')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Nivel Educativo</div>
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
                    <form action="{{route('almacena.nivel')}}" method="post">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="nivel_educativo" class="col-md-4 col-form-label text-md-right">NIVEL EDUCATIVO</label>
                            <div class="col-md-6">
                                <input id="nivel_educativo" type="text" class="form-control{{ $errors->has('nivel_educativo') ? ' is-invalid' : '' }}" placeholder="{{ $errors->has('nivel_educativo') ? ' Se requiere un nombre' : '' }}" name="nivel_educativo">
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-md-4 col-form-label text-md-right">URL AMIGABLE</label>
                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" >
                            </div>                       
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-danger"> GUARDAR </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection