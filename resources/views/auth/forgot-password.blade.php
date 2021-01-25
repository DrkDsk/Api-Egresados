@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card" style="top: -4.0rem;">
                <div class="card-header">
                    <p class="h3">Reiniciar Contraseña</p> 
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
                    
                   

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label> 

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Link de Reinicio de Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
