@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Trámites</h3>
                        </div>

                        <div class="card-body">
                        <table class="table"> 
                            
                            <thead class="text-center">
                                @if(!count($tramites))
                                <th scope="col">No hay Trámites Registrados</th>
                                @else
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col" style="width: 250px">Acciones</th>
                                    </tr>
                                @endif
                            </thead>

                            <tbody class="text-center">
                                @foreach ($tramites as $tramite)
                                <tr>
                                    <td scope="row">{{$tramite->id}}</td>
                                    <td>{{$tramite->tipo}}</td>
                                    <td>
                                        @if($tramite->finalizado)
                                            Finalizado
                                        @else 
                                            En Trámite
                                        @endif
                                    </td>
                                    
                                    <td>
                                    @if(!$tramite->finalizado)
                                        <a href="{{route('tramite.finish',$tramite->id)}}" class="btn btn-outline-success btn-sm">
                                            Finalizar
                                        </a>
                                    @else
                                        <a href="{{route('tramite.finish',$tramite->id)}}" class="btn btn-warning btn-sm">
                                            Reestablecer
                                        </a>
                                    @endif
                                    
                                        <a href="{{route('egresados.citas',$tramite->id)}}" class="btn btn-info btn-sm">
                                            Citar
                                        </a>

                                        <a onclick="confirmation(event)" href="{{route('tramites.delete',$tramite->id)}}" class="btn btn-danger btn-sm btn-delete">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            title: '¿Estás Seguro que deseas eliminar el Trámite?',
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
                        text:'El Trámite ha sido eliminado.',
                        icon:'success',
                    })
                    .then(() => {
                        location.reload();
                    });
                })
                .catch(error => {
                    Swal.fire(
                    'Ocurrió un error!',
                    'El Trámite no ha sido eliminado.',
                    'error');
                });
            }
        })
    }
</script>

@endsection