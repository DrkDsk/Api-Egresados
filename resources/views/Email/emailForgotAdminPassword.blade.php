@component('mail::message')
# ITTG

Se Ha Solicitado Reestablecer la Contraseña, Presiona
El Botón para Reestablecer tu Contraseña

@component('mail::button', ['url' => ($url)])
Reestablecer Contraseña
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
