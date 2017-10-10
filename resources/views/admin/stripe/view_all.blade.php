@extends('admin_master')
@section('title','Crear nuevo pago en Romfly Viajes')
@section('create','class=active')

@section('content')
	<h1 class="lato-300 text-center blue">Situacion pagos</h1>
	<table class="table table-responsive table-striped">
		<tr>
			<th>Cliente</th>
			<th>Correo</th>
			<th>Fecha creacion</th>
			<th>Status</th>
			<th>Cantidad</th>
			<th>Detalles</th>
		</tr>
	    @foreach ($links as $link)

	    <tr>
	    	<td><p class="roboto">{{ $link->firstname . " ".$link->lastname }}</p></td>
	    	<td><p class="roboto">{{ $link->email }}</p></td>
	    	<td><p class="roborto">{{ $link->created_at }}</p></td>
	    	<td><p class="roboto">{{ $link->status }}</p></td>
	    	<td><p class="roboto">{{ number_format($link->quantity,2) }} €</p></td>
	    	<td><a href="{{ url('admin/stripe/link/'.$link->id) }}">Ver</a></td>
	    </tr>

        @endforeach
    </table>
        	
@stop