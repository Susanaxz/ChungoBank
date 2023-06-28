@extends('layouts.layout')

@section('header', 'Gestión comercial')

@section('content')
		<section>
			<form>
				<label>Nº Ident. Fiscal</label><br>
				<input type="text" id="nif" required  value=''>
				<input type="text" id='nombre' readonly value=''>
				<span id='mensajes'>Zona de mensajes</span>
				<br><br>
			</form>
		</section>
@endsection