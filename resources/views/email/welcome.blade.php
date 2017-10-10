@component('mail::message')
# Hola viajero

Esta es la aplicacion de pago seguro con la tarjeta de Romfy Viajes.
Vas a pagar la cantidad de {{ number_format($link->quantity, 2) }} €, si estas de acuerdo con la 
cantidad haz clic en el boton de abajo, si no estas de acuerdo ignora este mensaje.

@component('mail::button', ['url' => url('pagar/'.$link->token.'/'.$link->email) ])
Ir a pagar
@endcomponent

Gracias,<br>
Romfly Viajes.
@endcomponent
