@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                    @if(Auth::user()->admin)
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <strong>Administrador <br>{{Auth::user()->name}}</strong>
                            </div>
                            <div class="col">
                                <div class="float-right"><a href="{{route('crear.delegado')}}" type="button" class="btn btn-success">Nuevo Delegado</a></div>
                            </div>
                        </div> 
                    </div>

                    @else
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <strong> Usuario <br>{{Auth::user()->name}}</strong>
                            </div>
                            <div class="col">
                                <div class="float-right"><a href="{{route('new.delegado')}}" type="button" class="btn btn-success">Nuevo Delegado</a></div>
                            </div>
                        </div> 
                    </div> 
                    @endif
                    <div class="card-body">
                        
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
