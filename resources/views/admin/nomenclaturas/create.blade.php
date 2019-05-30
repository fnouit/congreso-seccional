@extends('layouts.app')
@section('title', 'Nomenclatura │ Nuevo')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear una nueva Nomenclatura delegacional</div>
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
                    <form action="{{route('almacena.nomenclatura')}}" method="post">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="nomenclatura" class="col-md-4 col-form-label text-md-right">INGRESA NOMENCLATURA DELEGACIONAL</label>
                            <div class="col-md-6">
                                <input id="nomenclatura" type="text" class="form-control{{ $errors->has('nomenclatura') ? ' is-invalid' : '' }}" placeholder="{{ $errors->has('nomenclatura') ? ' Se requiere un nombre' : '' }}" name="nomenclatura">
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