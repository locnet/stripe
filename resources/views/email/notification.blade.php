@component('mail::message')
# Hola Adrian,

{{ ucfirst($user }} a pagado la cantidad de  {{ number_format($link->quantity, 2) }} €
 en concepto de {{ $details }}.
 Yuuupiii!!!!
@endcomponent
