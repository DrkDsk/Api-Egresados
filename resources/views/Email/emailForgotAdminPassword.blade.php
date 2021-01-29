@component('mail::message')
# ITTG

Se Ha Solicitado Restablecer la Contraseña, Presiona
El Botón para Restablecer tu Contraseña

@component('mail::button', ['url' => ($url)])
Restablecer Contraseña
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent