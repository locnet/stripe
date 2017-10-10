@extends('admin_master')
@section('title','Crear nuevo pago en Romfly Viajes')
@section('create','class=active')

@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
        	<h1 class="lato-300 text-center blue">Datos de pago</h1>
            <h3 class="lato-300">Detalles: </h3>
            <ul>
                <li><p class="roboto">Cantidad: {{ number_format($link->quantity, 2) }} €</p></li>
                <li><p class="roboto">Titular: {{ $link->firstname .' ' .$link->lastname }}</p></li>
                <li><p class="roboto">Telefono: {{ $link->phone }}</p></li>
                <li><p class="roboto">Correo electronico: {{ $link->email }}</p></li>
                <li><p class="roboto">Fecha creacion: {{ $link->created_at }}</p></li>
                @if ($link->status === 'succeeded')
                    @if ($link->token)
                        <li><p class="roboto">Pagado en: {{ $link->token->created_at }}</p></li>
                    @elseif (is_null($link->token))
                        <li><p class="roboto"><span class="red">Advertencia</span>: no hay token de Stripe</p></li>
                    @endif
                @else
                    <li>
                        <p class="roboto">
                            <a href="{{ url('pagar/'.$link->link_token.'/'.$link->email) }}">Enlace de pago</a>
                        </p>
                    </li>
                @endif
                
            </ul>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary">
                <a href="{{ URL::previous() }}" class="white">Volver</a>
            </button>
        </div>
    </div>
        	
@stop