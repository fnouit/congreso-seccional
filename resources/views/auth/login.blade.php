@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Ingresa tus datos de registro') }}</div>
                <div class="card-body">
                    <center>
                        <form method="POST" action="{{ route('login') }}" class="col-md-6">
                            @csrf
                            <div class="form-group row">
                                <label for="email">{{ __('Dirección de correo electrónico') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="password">{{ __('Contraseña de registro') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>       

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('  Iniciar sesión  ') }}
                                    </button>
                                </center>
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
