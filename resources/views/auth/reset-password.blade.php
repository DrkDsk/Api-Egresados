@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="top: -4.0rem;">
                <div class="card-header">
                    <p class="h3">Reiniciar Contraseña</p> 
                </div>

                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <img src="{{url('assets/img/tecnm.png')}}" style="width:31%; height: 40%;">
                        <img src="{{url('assets/img/icon.png')}}" style="width:15%;">
                    </div>
                    
                    <div class="card-text">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="input-group mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reiniciar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
