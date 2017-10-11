@component('mail::message')
# Hola {{ ucfirst($link->firstname) ." ".ucfirst($link->lastname) }},

Gracias por el pago de {{ number_format($link->quantity, 2) }} € que has efectuado en Romfly Viajes. La agencia ha sido 
avisada del pago, si deseas te puedes poner en contacto con nosotros en el numeros 9187 00 693 / 6789 71 657.



Gracias,<br>
Romfly Viajes.
@endcomponent
