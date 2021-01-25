@extends('layouts.nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">

                <div class="card" style="top: -4.0rem;">
                    <div class="card-header">
                        <p class="h3">Doble Factor de Autenticación</p>
                    </div>
                    
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <img src="{{url('assets/img/tecnm.png')}}" style="width:31%; height: 40%;">
                            <img src="{{url('assets/img/icon.png')}}" style="width:15%;">
                        </div>
                        
                        <p class="text-center mb-4">Por Favor, Introduce tu Código de Verificación</p>

                        <div class="card-text pt-0">
                            <form method="POST" action="{{ route('two-factor.login') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <label for="recovery_code" class="col-md-4 col-form-label text-md-right">Código de Verificación</label>
                                    <input id="recovery_code" type="recovery_code" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autocomplete="current-recovery_code">
                                    <div class="input-group-append">
                                        
                                        <div class="input-group-text">
                                                <span class="material-icons">lock</span>
                                            </div>
                                        @error('recovery_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mb-0 ">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
