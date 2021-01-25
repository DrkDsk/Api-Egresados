@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        
        <div class="card">
                <div class="card-header">

                    <form class="row g-3" action="{{route('citas.enviarPendientes')}}"  method="POST" enctype="multipart/form-data">
                    @csrf

                    <h1 class="card-title">Reenviar Citas No Enviadas</h1>
                    <div class="col-md-12 form-group text-right">
                        <div class="text-right">
                            <button class="btn btn-primary">Reenviar Seleccionados</button>
                            <a onclick="back()" class="btn btn-danger" style="color: white;">Cancelar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="text-center table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Destino</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Asunto</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Seleccionar</th>
                                    <th scope="col" style="width: 100px">Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($citas as $cita)
                                <tr>
                                    <td>{{$cita->destino}}</td>
                                    <td>{{$cita->mensaje}}</td>
                                    <td>{{$cita->asunto}}</td>
                                    <td>{{$cita->fecha}}</td>
                                    <td>{{$cita->hora}}</td>
                                    <td scope="row"><input type="checkbox" name="option[]" id="checkbox" value="{{$cita->id}}" checked></td>
                                    <td>
                                        <a href="{{route('egresados.tramites', $cita->id)}}" class="btn btn-info btn-sm">
                                            <abbr title="Enviar"><i class="material-icons">email</i></abbr>
                                        </a>
                                        <a href="{{route('egresados.delete',$cita->id)}}" class="btn btn-danger btn-sm">
                                            <abbr title="Eliminar Trámite"><i class="material-icons">delete</i></abbr>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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