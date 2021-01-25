@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Filtrar</h2>
                    <form name="filterform" action="{{route('citas.filtrar')}}">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group">
                                        <div class="form-group">
                                            <label for="">Trámites</label>
                                            @if($tramiteS == ' ')
                                            <select onchange="submitForm()" name="tramite" id="tramite" class="custom-select">
                                                <option value="">Seleccione un Trámite</option>
                                                @foreach($tramites as $tramite)
                                                    <option value="{{$tramite->name}}">{{$tramite->name}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select onchange="submitForm()" name="tramite" id="tramite" class="custom-select">
                                                <option value="">Seleccione un Trámite</option>
                                                <option value="{{$tramiteS}}" selected>{{$tramiteS}}</option>
                                                @foreach($tramites as $tramite)
                                                    @if($tramiteS != $tramite->name)
                                                    <option value="{{$tramite->name}}">{{$tramite->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <div class="form-group">
                                            <label>Carreras</label>
                                            @if($carreraS == ' ')
                                            <select onchange="submitForm()" name="carrera" id="carrera" class="custom-select">
                                                <option value="">Seleccione una Carrera</option>
                                                @foreach($carreras as $carrera)
                                                    <option value="{{$carrera->name}}">{{$carrera->name}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select onchange="submitForm()" name="carrera" id="carrera" class="custom-select">
                                                <option value="">Selecciona una Carrera</option>
                                                <option value="{{$carreraS}}" selected>{{$carreraS}}</option>
                                                @foreach($carreras as $carrera)
                                                    @if($carreraS != $carrera->name)
                                                    <option value="{{$carrera->name}}">{{$carrera->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Citas</h3>
                    <div class="container text-right">
                        <form action="{{route('download.citas',[
                            'tramite' => $tramiteS,
                            'carrera' => $carreraS
                        ])}}">
                            <abbr title="Descargar como archivo Excel">
                            <button type="submit" class="btn btn-success"><i class="material-icons">save_alt</i></button></abbr>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive-md">
                    <table id="example1" class="text-center table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No. Control</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Tŕamite</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($citas as $cita)
                            <tr>
                                <td>{{$cita->noControl}}</td>
                                <td>{{$cita->carrera}}</td>
                                <td>{{$cita->tipo}}</td>
                                <td>{{$cita->fecha}}</td>
                                <td>{{$cita->hora}}</td>
                                <td>{{$cita->descripcion}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$citas->links()}}
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function submitForm(){
        document.filterform.submit();
    }
</script>