@extends('layouts.app')

@section('content')
<div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Tablero</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard v1</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$noUsuarios}}</h3>
                                        <p>Usuarios Registrados</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">supervisor_account</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$noEgresados}}</h3>
                                        <p>Egresados Registrados</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">person_add_alt_1</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$noTramites}}</h3>
                                        <p>Egresados con Trámites</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">text_snippet</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$noCitas}}</h3>
                                        <p>Citas Establecidas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">event_available</i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$newUsers}}</h3>
                                        <p>Nuevos Usuarios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">supervisor_account</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$newEgresados}}</h3>
                                        <p>Nuevos Egresados</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">person_add_alt_1</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{$newTramites}}</h3>
                                        <p>Nuevos Trámite</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">text_snippet</i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$newCitas}}</h3>
                                        <p>Nuevas Citas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion material-icons">event_available</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>

                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block">
                    <b>Versión</b> 3.1.0-rc
                    </div>
                    <strong>Sistema de Administración de Registro de Titulación de Egresados; 2020-2021 <a href="https://ittgegresados.online">ittgegresados.online</a>.</strong> Todos los Derechos Reservados.
                </footer>
            </div>
@endsection