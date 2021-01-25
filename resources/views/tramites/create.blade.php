@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container col-md-5">
            <div class="card" style="border:1px solid">
                <div class="card-header">
                    <h2 class="card-title">Crear Nuevo Trámite</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('listaTramites.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="">Nombre del Nuevo Trámite:</label>
                            <input id="trámite" type="text" class="form-control @error('trámite') is-invalid @enderror" name="trámite">
                            @error('trámite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Lista de Trámites Existentes</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-center table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre del Trámite</th>
                                    <th scope="col">Fecha de Creación</th>
                                    <th scope="col" style="width: 180px">Opciones</th>
                                </tr>
                            </thead>
    
                            <tbody>
                            @foreach($tramites as $tramite)
                                <tr>
                                    <td>{{$tramite->name}}</td>
                                    <td>{{$tramite->created_at}}</td>
                                    <td>
                                        <a href="{{route('listraTramites.edit',$tramite->id)}}" class="btn btn-info btn-sm">
                                                <abbr title="Editar Trámite"><i class="material-icons">edit</i></abbr>
                                        </a>
    
                                        <a onclick="confirmation(event)" href="{{route('listraTramites.delete',$tramite->id)}}" class="btn btn-danger btn-sm">
                                                <abbr title="Eliminar Trámite"><i class="material-icons">delete</i></abbr>
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
            confirmButtonText: 'Sí, Eliminarlo!'
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