@extends('admin_master')
@section('title','Crear nuevo pago en Romfly Viajes')
@section('create','class=active')

@section('content')
	<h1 class="lato-300 text-center blue">Crear nuevo pago</h1>
	<div class="col-md-12">
        {!! Form::open(['url' => '/admin/stripe/guardar']) !!}            
         
         <div class="row">         	
            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    {!! Form::label('firstname', 'Nombre:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-4 col-xs-12">
                    {!! Form::text('firstname', old('firstname'),
                              [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('firstname', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        	 <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    {!! Form::label('lastname', 'Apellido:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-4 col-xs-12">
                    {!! Form::text('lastname', old('lastname'),
                              [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('lastname', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        
        <div class="row">
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    <p>{!! Form::label('phone', 'Telefono:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    {!! Form::text('phone', old('phone'),
                    [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    <p>{!! Form::label('email', 'Email:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    {!! Form::text('email', old('email'),
                    [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    <p> {!! Form::label('details', 'Descripcion:', array('class' => 'control-label')) !!}</p>
                </div>
                <div class="col-md-10 col-xs-12">
                    <p> {!! Form::textarea('details', old('details'),
                         ['class' => 'form-control admin-form']) !!} </p>
                </div>
            </div>
        </div>
        
        <div class="row">
        	 <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                <div class="col-md-2 col-xs-12 control-label">
                    <p>{!! Form::label('quantity', 'Cantidad:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('quantity', old('quantity'),
                    [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('quantity', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        

        <div class="form-group text-center">
            <p>{!! Form::submit('Crear link de pago', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        
        {!! Form::close() !!}
        
    </div>
    	
	
@stop