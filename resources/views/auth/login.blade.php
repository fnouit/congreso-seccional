@extends('layouts.login')

@section('content')


<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Acceder</h1>
                    <p class="text-muted">Control de acceso al sistema</p>
                    <div class="input-group mb-3">
                        <span class="input-group-addon"><i class="icon-user"></i></span>
                        <input id="email" type="email" name="email"  placeholder="Usuario" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                        <input id="password" name="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <button type="submit" class="btn btn-primary px-4">{{ __('  Iniciar sesión  ') }}</button>
                        </div>
                    </div>
                </form>


            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>SIDEC-2020</h2>
                <strong>Si</strong>stema a <strong>De</strong>legados <strong>C</strong>ongreso 2020
                <hr>
                <p>Sistema de registros a delegados para el Congreso de la Sección 56 del SNTE.</p>

                <a href="https://www.udemy.com/user/juan-carlos-arcila-diaz/" target="_blank" class="btn btn-primary active mt-3">Ver el curso!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
