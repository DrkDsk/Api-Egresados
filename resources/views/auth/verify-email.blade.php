@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Verificar Correo Electrónico') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Antes de Proceder, por favor checa tu bandeja de email para verificar tu correo electrónico') }}
                    {{ __('Si no recibiste el correo electrónico') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click aquí para solicitarlo otra vez') }}</button>.
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
