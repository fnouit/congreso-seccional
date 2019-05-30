@extends('layouts.app')
@section('title', 'Delegacion │ Editar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>DELGACIÓN</strong> {{ $delegacion->nomenclatura->nomenclatura }}{{ $delegacion->numero }}</div>
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
                    <form action=" {{route('actualizar.delegacion',[$delegacion->slug])}} " method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group ">
                            <label for="nomenclatura"><h5 class="text-center text-uppercase text-secondary" >NOMENCLATURA DELEGACIÓNAL</h5></label>
                            <select class="custom-select" name="nomenclatura">
                                <option value="{{$delegacion->nomenclatura->id}}">
                                    {{$delegacion->nomenclatura->nomenclatura}}
                                </option>
                                @foreach($nomenclaturas as $n)
                                <option value="{{$n->id}}">{{$n->nomenclatura}}</option>
                                @endforeach
                            </select>        
                        </div>

                        <div class="form-group mb-3">
                            <label for="numero"><h5 class="text-center text-uppercase text-secondary" >NÚMERO DELEGACIONAL</h5></label>
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="Número delegacional" value="{{ old('numero', $delegacion->numero) }}"  required>                    
                        </div>

                        <div class="form-group">
                            <label for="sede"><h5 class="text-center text-uppercase text-secondary" >SEDE DE LA DELEGACIÓN</h5></label>
                            <input type="text" name="sede" id="sede" class="form-control" placeholder="Nombre de la delegación" value="{{old('sede', $delegacion->sede)}}" required>
                        </div>

                        <div class="form-group">
                            <label for="niveles"><h5 class="text-center text-uppercase text-secondary" >NIVEL DE LA DELEGACIÓN</h5></label>
                            <select class="custom-select" name="nivel" required>                                
                                <option value="{{$delegacion->nivel->id}}">
                                    {{$delegacion->nivel->nivel_educativo}}
                                </option>

                                @foreach($niveles as $nivel)
                                    <option value="{{$nivel->id}}">{{$nivel->nivel_educativo}}</option>
                                @endforeach
                            </select>        
                        </div>

                        <div class="form-group">
                            <label for="regiones"><h5 class="text-center text-uppercase text-secondary" >REGIÓN A LA QUE PERTENECE</h5></label>
                            <select class="custom-select" name="region" required>
                                <option value="{{ $delegacion->region->id }}" {{ ( $delegacion->region_id == $delegacion->region->id ) ? 'selected' : '' }}>
                                    {{$delegacion->region->nombre}} - {{$delegacion->region->sede}}
                                </option>
                                @foreach($regiones as $region)
                                    <option value="{{$region->id}}">{{$region->nombre}} - {{$region->sede}}</option>
                                @endforeach
                            </select>        
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl btn-block" id="sendMessageButton">Crear</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection