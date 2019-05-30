@extends('layouts.app')

@section('title', 'Delegado │ Mostrar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                
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
                        <div class="col-md-4 text-center">
                            <div class="pic">
                                <img width="180px" class="img-thumbnail" src="{{Storage::url($delegado->imagen)}}" alt="">
                                <p class="info">
                                    <span class="field-value">{{$delegado->delegacion->nomenclatura->nomenclatura}}{{$delegado->delegacion->numero}}</span>
                                    <br><span class="field-value">{{$delegado->delegacion->region->nombre}}</span>
                                    <br><span class="field-value">{{$delegado->delegacion->region->sede}}</span>
                                </p>
                            </div>                           
                        </div>

                        <div class="col-md-8">
                            <div id="about" class="cvitae-section cvitae-about-me">
                                <div class="cvitae-container">
                                    <div class="cvitae-section-content">
                                        <div class="content-right about">
                                            <h3 class="cvitae-section-title">{{$delegado->nombre}}</h3>
                                            <p class="info">
                                                <span class="field-title"> <strong> Nombre Completo </strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->ap_paterno}} {{$delegado->ap_materno}} {{$delegado->nombre}}</span>
                                            </p>
                                            <p class="info">
                                                <span class="field-title"><strong>RFC</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->rfc}}</span>
                                            </p>
                                            <p class="info">
                                                <span class="field-title"><strong>Estado Civil</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->situacion->estado_civil}}</span>
                                            </p>
                                            <p class="info">
                                                <span class="field-title"><strong>Grado de Estudios</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->estudio->maximo_estudio}}</span>
                                            </p>

                                            <p class="info">
                                                <span class="field-title"><strong>Correo</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->email}}</span>
                                            </p>

                                            <p class="info">
                                                <span class="field-title"><strong>Teléfono</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->telefono}}</span>
                                            </p>

                                            <p class="info">
                                                <span class="field-title"><strong>Facebook</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value"> {{$delegado->facebook}}</span>
                                            </p>

                                            <p class="info">
                                                <span class="field-title"><strong>Twitter</strong></span> 
                                                <span class="field-separator">:</span> 
                                                <span class="field-value">{{$delegado->twitter}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <div class="col-xs-12 col-sm-12  form-group ">
                        <a href="{{ URL::previous() }}" type="button"  class="btn btn-primary">Atras</a> 
                    </div>
                </div>    

            </div>
        </div>
    </div>
</div>
@endsection