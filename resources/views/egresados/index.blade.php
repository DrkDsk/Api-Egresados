@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Filtrado</h2>
                    <form name="filterform" action="{{route('egresados.filtrar')}}">
                        <div class="row">
                            
                            <div class="col-md-3 form-group">
                                <div class="form-group">
                                    <label>Carreras</label>
                                    @if($career == ' ')
                                    <select name="carrera" id="carrera" class="form-control col-md-13">
                                        <option value="">Seleccione una Carrera</option>
                                        @foreach($carreras as $carrera)
                                        <option value="{{$carrera->name}}">{{$carrera->name}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select name="carrera" id="carrera" class="form-control col-md-13">
                                        <option value="">Seleccione una Carrera</option>
                                        <option value="{{$career}}" selected>{{$career}}</option>
                                        @foreach($carreras as $carrera)
                                            @if($carrera->name != $career)
                                            <option value="{{$carrera->name}}">{{$carrera->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 form-group">
                                <div class="form-group">
                                    <label>Buscar Por:</label>
                                    <select class="form-control col-md-8" name="opcion" id="select">
                                        <option value="name">Nombre</option>
                                        <option value="noControl">Número de Control</option>
                                        <option value="apellido1">Apellido Paterno</option>
                                        <option value="apellido2">Apellido Materno</option>
                                    </select>
                                    
                                </div>
                                <input placeholder="Ingrese campo:" type="text" name="inputOption" class="form-control col-10" aria-label="Text input with dropdown button">
                            </div>

                            <div class="col-md-2 form-group">
                                <div class=" text-center">
                                    <label for="anioSpe">Año
                                        <input type="radio" id="anioSpe" name="anioSpe">
                                    </label>
                                </div>
                                <div id="divByYear" class="text-center">
                                    <div class="form-group" id="divAnio">
                                        <label for="">Año de Ingreso: </label>
                                            @if($yearIngresoSelected == ' ')
                                            <select onchange="hideFechaEspecifica(1)" class="form-control" name="yearIngreso" id="">
                                                <option value="">Selecciona Año de Ingreso</option>
                                                @foreach($yearsIngreso as $yearIngreso)
                                                <option value="{{$yearIngreso}}">{{$yearIngreso}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select onchange="hideFechaEspecifica(1)" class="form-control" name="yearIngreso" id="">
                                                <option value="">Selecciona Año de Ingreso</option>
                                                <option value="{{$yearIngresoSelected}}" selected>{{$yearIngresoSelected}}</option>
                                                @foreach($yearsIngreso as $yearIngreso)
                                                    @if($yearIngreso != $yearIngresoSelected)
                                                        <option value="{{$yearIngreso}}">{{$yearIngreso}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @endif
                                    </div>

                                    <div class="form-group" id="divAnio">
                                        <label for="">Año de Egreso: </label>
                                        @if($yearEgresoSelected == ' ')
                                        <select onchange="hideFechaEspecifica(1)" class="form-control" name="yearEgreso" id="">
                                            <option value="">Seleccione un Año de Egreso</option>
                                            @foreach($yearsEgreso as $yearEgreso)
                                            <option value="{{$yearEgreso}}">{{$yearEgreso}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select onchange="hideFechaEspecifica(1)" class="form-control" name="yearEgreso" id="">
                                                    <option value="">Seleccione un Año de Egreso</option>
                                                    <option value="{{$yearEgresoSelected}}" selected>{{$yearEgresoSelected}}</option>
                                            @foreach($yearsEgreso as $yearEgreso)
                                                @if($yearEgresoSelected != $yearEgreso)
                                                    <option value="{{$yearEgreso}}">{{$yearEgreso}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <div class=" text-center">
                                    <label for="radioRange">Rango de Fechas
                                        <input type="radio" name="radioRange" id="radioRange" onclick="hideFechaEspecifica(0)">
                                    </label>
                                </div>
                                <div id="divRange">
                                    <div id="divRange" class="form-group">
                                        <label for="">Fecha de Ingreso: </label>
                                        <input onchange="hideFechaEspecifica(0)" value="{{$dateRangeIngreso}}" id="fechaIngresoRange" type="date" class="form-control" name="fechaIngresoRange">
                                    </div>
                                    <div>
                                        <label for="">Fecha de Egreso: </label>
                                        <input onchange="hideFechaEspecifica(0)" value="{{$dateRangeEgreso}}" class="form-control" type="date" id="fechaEgresoRange" name="fechaEgresoRange">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <div class=" text-center">
                                    <label for="radioSpe">Fecha Específica
                                        <input type="radio" name="specificDate" id="radioSpe" onclick="hideRadios()">
                                    </label>
                                </div>
                                <div id="divSpeci">
                                    <div class="form-group">
                                        <label for="">Fecha de Ingreso: </label>
                                        <input value="{{$dateSpeIngreso}}" onchange="hideRadios()" id="fechaIngresoSpe" type="date" class="form-control" name="fechaIngresoSpe">
                                    </div>
                                    <div>
                                        <label for="">Fecha de Egreso: </label>
                                        <input value="{{$dateSpeEgreso}}" onchange="hideRadios()" id="fechaEgresoSpe" type="date" class="form-control" name="fechaEgresoSpe" onchange="hideRadios()">
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-warning">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Egresados</h3>
                    <div class="container text-right">
                        <form action="{{route('download.egresados',[
                        'carrera' =>  $career, 
                        'yearIngreso' => $yearIngresoSelected,
                        'yearEgreso'  => $yearEgresoSelected,
                        'dateIngresoRange' => $dateRangeIngreso,
                        'dateEgresoRange'  => $dateRangeEgreso,
                        'dateIngresoSpe'   => $dateSpeIngreso,
                        'dateEgresoSpe' => $dateSpeEgreso
                        ])}}">
                            <abbr title="Descargar como archivo Excel">
                            <button type="submit" class="btn btn-success"><i class="material-icons">save_alt</i></button></abbr>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-center table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido Paterno</th>
                                    <th scope="col">Apellido Materno</th>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Carrera</th>
                                    <th scope="col">Fecha de Ingreso</th>
                                    <th scope="col">Fecha de Egreso</th>
                                    <th scope="col" style="width: 180px">Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($egresados as $egresado)
                                <tr>
                                    <td>{{$egresado->name}}</td>
                                    <td>{{$egresado->apellido1}}</td>
                                    <td>{{$egresado->apellido2}}</td>
                                    <td>{{$egresado->noControl}}</td>
                                    <td>{{$egresado->carrera}}</td>
                                    <td>{{$egresado->fechaIngreso}}</td>
                                    <td>{{$egresado->fechaEgreso}}</td>
                                    <td>
                                        <a href="{{route('egresados.tramites', $egresado->id)}}" class="btn btn-info btn-sm">
                                            <abbr title="Ver Trámites"><i class="material-icons">info</i></abbr>
                                        </a>
                                        
                                        <a onclick="confirmation(event)" href="{{route('egresados.delete',$egresado->id)}}" class="btn btn-danger btn-sm">
                                            <abbr title="Eliminar Trámite"><i class="material-icons">delete</i></abbr>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$egresados->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    function confirmation(ev){
        ev.preventDefault();
        var url = ev.currentTarget.getAttribute('href');
        console.log(url);
        Swal.fire({
            title: '¿Estás Seguro que deseas eliminar el Egresado?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Cancelar',
            confirmButtonText: 'Sí, Eliminar!'
        }).then((result) => {
            if (result.value) {
                axios.get(url).then(result => {
                    Swal.fire({
                        title:'Eliminado!',
                        text:'El Egresado ha sido eliminado.',
                        icon:'success',
                    })
                    .then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire(
                    'Ocurrió un error!',
                    'El Egresado no ha sido eliminado.',
                    'error');
                });
            }
        })
    }
</script>
@endsection

<script>
    function hideRadios(){
        $('#divRange input[type="date"]').val('');
        $("#divAnio select").val('');
        document.getElementById("radioRange").checked  = false;
        document.getElementById("anioSpe").checked  = false;
        document.getElementById("radioSpe").checked  = true;
    }
    
    function hideFechaEspecifica(e){
        $('#divSpeci input[type="date"]').val('');
        document.getElementById("radioSpe").checked  = false;
        if(e == 1) document.getElementById("anioSpe").checked  = true;
        else document.getElementById("radioRange").checked  = true;
    }
</script>