@extends('admin_master')
@section('title','Crear nuevo pago en Romfly Viajes')
@section('create','class=active')

@section('content')
	<h1 class="lato-300 text-center blue">Link creado corectamente</h1>
    <h3 class="lato-300">Detalles: </h3>
    <ul>
        <li><p class="roboto">Cantidad: {{ $link->quantity }} €</p></li>
        <li><p class="roboto">Titular {{ $link->firstname .' ' .$link->lastname }}</p></li>
        <li><p class="roboto">Telefono {{ $link->phone }}</p></li>
        <li><p class="roboto"><a href="{{ url('admin/stripe/pagar/'.$link->token.'/'.$link->email) }}">Enlace</a></p></li>
    </ul>	
        	
@stop