@extends('layouts.layout')

@section('header', 'Consulta movimientos Cta Puntos')

@section('styles')
<style type="text/css">
    input#altamov {
        float: right;
    }

</style>
@endsection

@section('content')
<section>
<form id='formulario_mov' method="POST" action="{{ route('consulta.movimientos', $id) }}">

        @csrf


        @if ($cuenta)
        <label>CONTRATO PUNTOS:</label>
        <input type="text" id="entidad" name="entidad" disabled value="{{ $cuenta->entidad ?? null }}">
        <input type="text" id="oficina" name="oficina" disabled value="{{ $cuenta->oficina ?? null }}">
        <input type="text" id="digito" name="digito" disabled value="{{ $cuenta->dc ?? null}}">
        <input type="text" id="cuenta" name="cuenta" disabled value="{{ $cuenta->cuenta ?? null}}">



        @endif



        <input type="hidden" id="nif" value=''>
        <br><br>
        <label>FECHA DESDE:</label>
        <input type="date" id="fechadesde" name="fechadesde">
        <span>&nbsp&nbsp&nbsp</span>
        <label>FECHA HASTA:</label>
        <input type="date" id="fechahasta" name="fechahasta">
        <br><br>
        <label>OPERACIÓN:</label>
        <input type="radio" name="operacion" value='A'>&nbsp&nbsp<span>Asignación</span><br>
        <label></label>
        <input type="radio" name="operacion" value='D'>&nbsp&nbsp<span>Disposición</span><br>
        <label></label>
        <input type="radio" name="operacion" value='T' checked>&nbsp&nbsp<span>Todos</span>
        <br><br>
        <label>CONCEPTO</label>
        <input type="text" id="concepto" name="concepto">
        <br><br>
        <label>Últimos</label>
        <input type="checkbox" name="ultimos">
        <br>
        <hr><br>
        <label>ULTIMO EXTRACTO:</label>
        <input type="date" id="ultimoex" disabled>
        <span>&nbsp&nbsp&nbsp</span>
        <label>SALDO PUNTOS:</label>
        <input type="number" id="saldototal" disabled>
        <br><br>
        <hr><br>
        <table id='movimientos'>
            <tr>
                <th></th>
                <th>FECHA</th>
                <th>A/D</th>
                <th>CONCEPTO</th>
                <th>PUNTOS</th>
                <th>SALDO</th>
            </tr>
            <tr>
                @if ($movimientos)
                @foreach ($movimientos as $movimiento)
            <tr>
                <td><input type='radio' name='seleccion' value='{{ $movimiento->id }}'></td>
                <td>{{ $movimiento->fecha }}</td>
                <td>{{ $movimiento->operacion }}</td>
                <td>{{ $movimiento->concepto }}</td>
                <td>{{ $movimiento->puntos }}</td>
                <td>{{ $movimiento->saldomov }}</td>
            </tr>
            @endforeach
            @endif


            <br><br><br>
			<input type="submit" id="aceptar" value='Aceptar'>

            <input type="button" id="detalle" value='Detalle' onclick="window.location.href = 'detalle-movimiento'">
            <input type="button" id="imprimir" value='Imprimir'>
            <input type="button" id="salir" value='Abandonar' onclick="window.location.href = 'alta-mto-puntos'">
            <input type="button" id="altamov" value='Alta movimiento' onclick="window.location.href = 'alta-movimientos'">
            <span id='mensajes'>Zona de mensajes</span>
    </form>
</section>
@endsection
