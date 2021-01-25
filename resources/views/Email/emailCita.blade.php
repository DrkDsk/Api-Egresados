@component('mail::message')

<h3>Nueva Cita</h3>

Tienes una nueva cita a las {{$hora}} para el día: {{$fecha}}
acerca del Trámite Solicitado: {{$tramite}}

{{$mensaje}}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
