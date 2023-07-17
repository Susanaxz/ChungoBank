@extends('layouts.layout')

@section('header', 'Alta y Mantenimiento Cta Puntos')

@section('content')
<section>
<form id="formulario" method="post" action="{{ $persona->cuenta ? 
    route('modificar.cuenta', ['persona' => $persona->id]) : 
    route('alta.cuenta', ['persona_id' => $persona->id]) }}">

@csrf
@method($persona->cuenta ? 'PUT' : 'POST')
   



        
        <label>CONTRATO PUNTOS:</label>
        @if ($persona->cuenta)
        <input type="text" id="entidad" disabled value="{{ $persona->cuenta->entidad }}">
        <input type="text" id="oficina" disabled value="{{ $persona->cuenta->oficina }}">
        <input type="text" id="digito" disabled value="{{ $persona->cuenta->dc }}">
        <input type="text" id="cuenta" disabled value="{{ $persona->cuenta->cuenta }}">
        @endif



        <br><br>
        <label>TITULAR:</label>
        <input type="text" id="nif" value="{{ $persona->nif }}" disabled>
        <input type="text" id="titular" value="{{ $persona->nombre }} {{ $persona->apellidos }}" disabled>


        <br><br>
        <hr><br><br>

        
        <label>CÓDIGO PROGRAMA:</label>
        <select name="programa_id">
            @foreach($programas as $programa)
            <option value="{{ $programa->codigo }}" {{ $programa->codigo == $programaActual ? 'selected' : '' }}>
                {{ $programa->codigo }}
            </option>
            @endforeach
        </select>




        <br><br>
        <label>DESCRIPCIÓN PROGRAMA:</label>
        <input type="text" id='descripcion' disabled value="">
        


        <br><br>
        <label>RENUNCIA EXTRACTO:</label>
        <input type="checkbox" name="extracto" value="si" {{ $cuenta && $cuenta->extracto ? 'checked' : '' }}>
        <br><br>
        <label>RENUNCIA OBTENCIÓN PUNTOS:</label>
        <input type="checkbox" name="renuncia" value="si" {{ $cuenta && $cuenta->renuncia ? 'checked' : '' }}>


        <br><br><br>
        
        <input type="submit" id="altapuntos" value='Alta'>
        <input type="submit" id="modifpuntos" value='Modificar'>

        <input type="button" id="bajapuntos" data-id="{{ $persona->cuenta->id ?? '' }}" value='Baja'>


        <input type="button" id="movimientos" value='Consulta mvtos' onclick="window.location.href = '{{ route('consulta-movimientos', ['id' => $persona->id]) }}'">


        <input type="button" id="salir" value='Abandonar' onclick="window.location.href = '{{ url('gestion') }}'">
        <br><br><br>


        <span id='mensajes'></span>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif


    </form>


<script type="text/javascript">
    var programas = {
        @foreach($programas as $programa)
        "{{ $programa->codigo }}": "{{ $programa->descripcion }}"
        , @endforeach
    };

    var selectPrograma = document.querySelector('select[name="programa_id"]');

    selectPrograma.addEventListener('change', function() {
        var codigo = this.value;
        var descripcion = programas[codigo] || '';
        document.getElementById('descripcion').value = descripcion;
    });

    // Simulate a "change" event
    var event = new Event('change');
    selectPrograma.dispatchEvent(event);

</script>




</section>
@endsection
