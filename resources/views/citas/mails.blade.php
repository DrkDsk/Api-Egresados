@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Nueva Cita</h2>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{route('citar.sendEmail',[
                    'tramite' => $tramiteS, 
                    'carrera' => $carreraS,
                    'yearIngreso' => $yearIngresoSelected,
                    'yearEgreso'  => $yearEgresoSelected,
                    'dateIngresoRange' => $dateRangeIngreso,
                    'dateEgresoRange'  => $dateRangeEgreso,
                    'dateIngresoSpe' => $dateSpeIngreso,
                    'dateEgresoSpe'  => $dateSpeEgreso
                    ])}}">
                    @csrf
                        <div class="col-md-8 form-group">
                            <div class="form-group">
                                <label for="cita">Mensaje:</label>
                                <textarea name="mensaje" id="mensaje" cols="8" rows="3" class="form-control @error('mensaje') is-invalid @enderror"></textarea>
                                @error('mensaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cita">Asunto:</label>
                                    <input name="asunto" id="asunto" type="text" class="form-control @error('asunto') is-invalid @enderror"></input>
                                    @error('mensaje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="cita">Examinar Archivo:</label>
                                <input name="file" class="form-control" id="formFile" type="file">
                            </div>
                            <a onclick="clearFile()" class="btn btn-warning">Borrar Archivo</a>
                        </div>

                        <div class="col-md-4 form-group">
                            <div class="form-group">
                                <label for="cita">Fecha de cita:</label>
                                <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="hora">Hora de cita:</label>
                                <input id="hora" type="time" class="form-control @error('hora') is-invalid @enderror" name="hora">
                                    @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <a onclick="back()" class="btn btn-danger" style="color: white;">Cancelar</a>
                            </div>
                        </div>
                </div>
            </div>
                
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Egresados</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="text-center table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido Paterno</th>
                                    <th scope="col">Apellido Materno</th>
                                    <th scope="col">Trámite</th>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($egresados as $egresado)
                                <tr>
                                    <td scope="row">{{$egresado->name}}</td>
                                    <td scope="row">{{$egresado->apellido1}}</td>
                                    <td scope="row">{{$egresado->apellido2}}</td>
                                    <td scope="row">{{$egresado->tipo}}</td>
                                    <td scope="row">{{$egresado->carrera}}</td>
                                    <td scope="row"><input type="checkbox" name="option[]" id="checkbox" value="{{$egresado->id}}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$egresados->links()}}
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
        function back(){
            window.history.back();
        }

        function clearFile(){
            document.getElementById('formFile').value=""
        }
</script>