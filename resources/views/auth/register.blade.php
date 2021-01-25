@extends('layouts.nav')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card" style="top: -4.0rem;">
                
                    <div class="card-header">
                        <p class="h3">Registro de Usuario</p>
                    </div>
            
                    <div class="card-body">

                        <div class="card-title d-flex justify-content-between">
                            <img src="{{url('assets/img/tecnm.png')}}" style="width:31%; height: 40%;">
                            <img src="{{url('assets/img/icon.png')}}" style="width:15%;">
                        </div>
                        <p class="text-center mb-0">Correo Electrónico y Contraseña</p>

                        <div class="card-text pt-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="input-group mb-3">
                                    <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="material-icons">email</span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input id="password" placeholder="Contraseña" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" name="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="material-icons">lock</span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input id="password-confirm" placeholder="Repetir Contraseña" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="current-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="material-icons">lock</span>
                                        </div>
                                    </div>
                                    @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                
                                <div class="d-flex justify-content-end mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection