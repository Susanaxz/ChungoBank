@extends('layouts.layout')

@section('header', 'Alta Personas')

@section('content')
		<section>
			<form id='formulario' method="POST" action="{{ route('personas.alta')}}">
				@csrf

				
				<label>NIF:</label>
				<input type="text" id="nif" name="nif">
				<br><br>
				<label>NOMBRE:</label>
				<input type="text" id="nombre" name="nombre">
				<br><br>
				<label>APELLIDOS:</label>
				<input type="text" id="apellidos" name="apellidos">
				<br><br>
				<label>DIRECCION:</label>
				<input type="text" id="direccion" name="direccion">
				<br><br>
				<label>EMAIL:</label>
				<input type="text" id="email" name="email">				
				<br><br>
				<label>TARJETA</label>
				<input type="text" maxlength='4' id="pan1" name="tarjeta1" value="{{ $tarjeta1 ?? '' }}" readonly>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan2" name="tarjeta2" value="{{ $tarjeta2 ?? '' }}" readonly>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan3" name="tarjeta3" value="{{ $tarjeta3 ?? '' }}" readonly>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan4" name="tarjeta4" value="{{ $tarjeta4 ?? '' }}" readonly>
				<br><br><br>
				<input type="submit" id="alta" value='Alta' >
				<input type="button" id="salir" value='Abandonar' onclick="window.location.href = 'gestion'">
				<span id='mensajes'>Zona de mensajes</span>

				@if ($errors->any())
				<div class="alert alert-danger">
				    <ul>
				        @foreach ($errors->all() as $error)
				        <li>{{ $error }}</li>
				        @endforeach
				    </ul>
				</div>
				@endif

			</form>
		</section>
@endsection