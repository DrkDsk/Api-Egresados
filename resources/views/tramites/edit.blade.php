@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container col-5">
            <div class="card" style="border:1px solid">
                <div class="card-header">
                    <h2 class="card-title">Actualizar Nombre Trámite</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('listraTramites.update',$tramite->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                        <div class="form-group">
                            <label for="">Nuevo Nombre del Trámite:</label>
                            <input placeholder="Ingresa El Nuevo Nombre del Trámite" id="trámite" type="text" class="form-control @error('trámite') is-invalid @enderror" value="{{$tramite->name}}" name="trámite">
                            @error('trámite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection