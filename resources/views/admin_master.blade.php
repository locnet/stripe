<!DOCTYPE html>
<html lang="es">
    <head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content=" @yield('meta_description') ">
	    <meta name="google-signin-client_id" content="@yield('google_profile_id')">
		<title>@yield('title')</title>			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		@yield('customcss')		
    </head>
	<body>
		<div class="full-width-container">
			<div class="col-md-2 left-menu">	    		
	    		<div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse"
		                    data-target="#mainNavbar">
		                <span class="fa fa-bars"></span>
		            </button>				            
		        </div>
	            <nav class="navbar">
				    <div>				        
					    <div class="collapse navbar-collapse" id="mainNavbar">
					        <ul class="nav nav-stacked">
					            <li @yield('inicio')>
					            	<a href="{{ url('admin') }}">
					            	<span class="fa fa-home"></span>Inicio</a>
					            </li>
					            <li @yield('pago')>
					            	<a href="{{ url('/admin/tours') }}" class="dropdown-toggle" 
					            	    data-toggle="dropdown">
					            	    <span class="fa fa-circle-o"></span>
					            	    Stripe<span class="caret"></span>
					            	</a>
		                            <ul class="dropdown-menu">
		                            	<li @yield('create')>
		                            		<a href="{{ url('/admin/stripe/nuevo') }}">
		                            	    Crear pago</a>
		                                </li>
		                            	<li @yield('tours')><a href="{{ url('/admin/tours/nuevo') }}">Buscar</a></li>
		                            </ul>
					            </li>
					            <li @yield('ofertas')>
					            	<a href="" class="dropdown-toggle" 
					            	    data-toggle="dropdown">
					            	    <span class="fa fa-money"></span>
					            	    Ofertas<span class="caret"></span>
					            	</a>
		                            <ul class="dropdown-menu">
		                            	<li @yield('ofertas_all')><a href="{{ url('/admin/ofertas') }}">Todas</a></li>
		                            	<li @yield('ofertas')><a href="{{ url('/admin/ofertas/nueva') }}">Nueva</a></li>
		                            </ul>
					            </li>
					            
					            <li @yield('destinos')>
					            	<a href="{{ url('/admin/destinos') }}" class="dropdown-toggle" 
					            	    data-toggle="dropdown">
					            	    <span class="fa fa-suitcase"></span>Destinos
					            	    <span class="caret"></span>
					                </a>
					                <ul class="dropdown-menu">
		                            	<li><a href="{{ url('/admin/destinos') }}">Activos</a></li>
		                            	<li @yield('tours')><a href="{{ url('/admin/destinos/todos') }}">Añadir</a></li>		                                
		                            </ul>
					            </li> 
					            
					            <li @yield('procentajes')>
					            	<a href="{{ url('admin/procentajes') }}">
					            		<span class="fa fa-percent"></span>Procentajes
					            	</a>
					            </li>
					            <li @yield('reservas')>
					            	<a href="{{ url('admin/reservas') }}">
					            		<span class="fa fa-shopping-cart"></span>Reservas
					            	</a>
					            </li>
					            <li @yield('agencias')>
					            	<a href="{{ url('admin/agencias') }}">
					            		<span class="fa  fa-address-card-o"></span>Agencias
					            	</a>
					            </li>
					            @if (Auth::user() && Auth::check())						                
					                <li><a href="{{ url('/auth/logout') }}">
					                	<span class="fa fa-user"></span> Logout
					                </a></li>
					            @else
					                <li><a href="{{ url('/auth') }}">
					                	<span class="fa fa-user"></span> Login
					                </a></li>
					            @endif
					        </ul>
					    </div>
				    </div>
				</nav>
			</div>
			<div class="col-md-10 col-xs-12">
			     <div class="collapse navbar-collapse" id="socialNavbar">
			    	<ul class="nav navbar-nav navbar-right mobile">
			    		<li id="status">
			    			@if (Auth::user() && Auth::check())	
			    		        <h3 class="lato-300 blue"><span class="fa fa-user"></span> {{ ucfirst(Auth::user()->name) }}</h3>
			    		    @endif
			    		</li>
		            </ul>
			    </div>
			    <div class="col-md-10 col-md-offset-1 col-xs-12">		
			        @yield('content')
			    </div>
			</div>
		</div>
	    	    
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	    @yield('customjs')
	</body>
</html>