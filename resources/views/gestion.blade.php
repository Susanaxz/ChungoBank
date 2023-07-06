@extends('layouts.layout')

@section('header', 'Gestión comercial')

@section('content')
<section>
    <form id="form" method='get' action='{{ url("personas/") }}'>
        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" required value="{{ $persona->nif ?? null }}" onblur='enviar()'>

        @if ($errors->has('nif'))
        <span id='mensajes'>{{ $errors->first('nif') }}</span>
        @endif

        <input type="text" id='nombre' readonly value="{{ $persona->nombre ?? null }} {{ $persona->apellidos ?? null }}">
        <span id='mensajes'>Zona de mensajes</span>
        <br><br>
    </form>

    <script type="text/javascript">
        function enviar() {
            let form = document.querySelector('#form');
            let nif = document.querySelector('#nif').value;
            form.action = "{{ url('personas') }}/" + nif;
            form.submit();

        }

    </script>
</section>
@endsection


