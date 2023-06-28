@extends('layouts.layout') // extiende de la plantilla layout.blade.php y que contiene el código HTML común a todas las páginas de la aplicación

@section('header', 'Detalle movimiento Cta Puntos') // define el contenido de la sección header de la plantilla layout.blade.php

@section('styles') // define el contenido de la sección styles de la plantilla layout.blade.php

	<style type="text/css">
		input#altamov {float:right;}
	</style>
@endsection

@section('content') // define el contenido de la sección content de la plantilla layout.blade.php
		<section>
			<form id='formulario_mov'>
				<label>CONTRATO PUNTOS:</label>
				<input type="text" id="entidad" disabled>
				<input type="text" id="oficina" disabled>
				<input type="text" id="digito" disabled>
				<input type="text" id="cuenta" disabled>
				<input type="hidden" id="nif" value=''>
				<br><br>
				<label>FECHA MOVIMIENTO:</label>
				<input type="date" id="fecha" disabled>
				<br><br>
				<label>CONCEPTO</label>
				<input type="text" id="concepto" disabled>
				<br><hr><br>
				<label>TARJETA</label>
				<input type="text" maxlength='4' id="pan1" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan2" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan3" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<input type="text" maxlength='4' id="pan4" disabled>
				<br><br>
				<label>LOCALIZADOR</label>
				<input type="text" id="localizador" disabled>
				<br><br>
				<label>COMERCIO</label>
				<input type="text" id="comercio" disabled>
				<br><br>
				<label>COMENTARIOS</label>
				<textarea id="comentarios" disabled></textarea>
				<br><br><br>
				<input type="button" id="salir" value='Abandonar' onclick="window.location.href = 'consulta-movimientos.html'">
				<span id='mensajes'>Zona de mensajes</span>
			</form>
		</section>
	@endsection