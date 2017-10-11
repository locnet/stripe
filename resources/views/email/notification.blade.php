@component('mail::message')
# Hola Adrian,

{{ ucfirst($link->firstname) ." ".ucfirst($link->lastname) }} a pagado la cantidad de  {{ number_format($link->quantity, 2) }} €
 en concepto de {{ $link->details }}.

@endcomponent
