@component('mail::message')
# Reestablecer Contraseña

Para reestablecer tu contraseña, copia el siguiente código y pégalo en el
recuadro de la aplicación móvil.

<h2>Código de Verificación:</h2>
{{$token}}
<p></p>

Gracias,<br>
{{ config('app.name') }}
@endcomponent
