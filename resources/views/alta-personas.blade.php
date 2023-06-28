@extends('layouts.layout')

@section('header', 'Alta Personas')

@section('content')
		<section>
			<form id='formulario'>
				<label>NIF:</label>
				<input type="text" id="nif">
				<br><br>
				<label>NOMBRE:</label>
				<input type="text" id="nombre">
				<br><br>
				<label>APELLIDOS:</label>
				<input type="text" id="apellidos">
				<br><br>
				<label>DIRECCION:</label>
				<input type="text" id="direccion">
				<br><br>
				<label>EMAIL:</label>
				<input type="text" id="email">				
				<br><br>
				<label>TARJETA</label>
				<input type="text" maxlength='4' id="pan1" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan2" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan3" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan4" disabled>
				<br><br><br>
				<input type="button" id="alta" value='Alta'>
				<input type="button" id="salir" value='Abandonar' onclick="window.location.href = 'gestion'">
				<span id='mensajes'>Zona de mensajes</span>
			</form>
		</section>
@endsection