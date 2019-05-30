@extends('layouts.app')

@section('title', 'Regiones')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Regiones</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">SEDE</th>
                                <th scope="col">COORDINADOR</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">FILE IMAGEN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regiones as $key => $region)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td> <a href="{{route('mostrar.regiones',[$region->slug])}}"> {{$region->nombre}} </a> </td>
                                <td>{{$region->sede}}</td>
                                <td>{{$region->coordinador}}</td>
                                <td>{{$region->email}}</td>
                                <td>{{$region->telefono}}</td>
                                <td><img width="80px" class="img-thumbnail" src="{{Storage::url($region->photo_extension)}}" alt=""></td>
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