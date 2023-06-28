@extends('layouts.layout') // extiende de la plantilla layout.blade.php y que contiene el código HTML común a todas las páginas de la aplicación

@section('header', 'Alta y Mantenimiento Cta Puntos') 

@section('content')
		<section>
			<form id='formulario'>
				<label>CONTRATO PUNTOS:</label>
				<input type="text" id="entidad" disabled>
				<input type="text" id="oficina" disabled>
				<input type="text" id="digito" disabled>
				<input type="text" id="cuenta" disabled>
				<br><br>
				<label>TITULAR:</label>
				<input type="text" id="nif" value='' disabled>
				<input type="text" id="titular" value='' disabled>
				<br><br><hr><br><br>
				<label>CÓDIGO PROGRAMA:</label>
				<select id='codigo'>
					<option disabled selected value=''>Seleccione código</option>
					<option>PBS</option>
					<option>PAV</option>
					<option>PPR</option>
				</select>
				<br><br>
				<label>DESCRIPCIÓN PROGRAMA:</label>
				<input type="text" id='descripcion' disabled>
				<br><br>
				<label>RENUNCIA EXTRACTO:</label>
				<input type="checkbox" name="extracto" value='si'>
				<br><br>
				<label>RENUNCIA OBTENCIÓN PUNTOS:</label>
				<input type="checkbox" name="renuncia" value='si'>
				<br><br><br>
				<input type="button" id="altapuntos" value='Alta'>
				<input type="button" id="modifpuntos" value='Modificar'>
				<input type="button" id="bajapuntos" value='Baja'>
				<input type="button" id="movimientos" value='Consulta mvtos' onclick="window.location.href = 'consulta-movimientos.html'">
				<input type="button" id="salir" value='Abandonar' onclick="window.location.href = 'gestion.html'">
				<span id='mensajes'>Zona de mensajes</span>
			</form>
		</section>
@endsection