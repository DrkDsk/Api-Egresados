@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container col-md-6">
            <div  class="card">
                <div class="card-header">
                    <h2 class="card-title">Doble Factor de Autenticación</h2>
                </div>

                <div class="card-body">
                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-success" role="alert">
                            Se ha Deshabilitado el Doble Factor de Autenticación
                        </div>
                    @endif

                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            Se ha Habilitado el Doble Factor de Autenticación
                        </div>
                    @endif

                    <form method="POST" action="/user/two-factor-authentication">
                        @csrf

                        @if (auth()->user()->two_factor_secret)
                            @method('DElETE')

                            <div class="pb-5">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>

                            <div>
                                <h3>Códigos de Recuperación:</h3>
                                <ul>
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button class="btn btn-danger">Desactivar</button>
                        @else
                            <button class="btn btn-primary">Activar</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
