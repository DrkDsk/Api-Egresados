@component('mail::message')

Invitación de Registro de Usuario.

Presione El Siguiente Botón Para Completar el Registro

@component('mail::button', ['url' => ($url)])
Completar Registro
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent