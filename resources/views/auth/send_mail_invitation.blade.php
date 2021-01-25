@extends('layouts.nav')
@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card" style="top: -4.0rem;">
                    <div class="card-header">
                        <p class="h3">Enviar Invitación de Registro</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="card-title d-flex justify-content-between">
                            <img src="{{url('assets/img/tecnm.png')}}" style="width:31%; height: 40%;">
                            <img src="{{url('assets/img/icon.png')}}" style="width:15%;">
                        </div>

                        <p class="text-center mb-1">Correo Electrónico a Invitar</p>

                        <div class="card-text pt-4">
                            <form method="POST" action="{{ route('sendEmail.register') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                
                                <div class="d-flex justify-content-end mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar Link De Invitación
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
