<!DOCTYPE html>
<html>

<head>
    <title>Chungo Bank</title>
    <meta charset="utf-8">
    {{-- <link rel="stylesheet" type="text/css" href="assets/css/cb.css"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cb.css') }}">

    @yield('styles')
</head>

<body>
    <div class='contenedor'>
        <header>
            <img src="{{ asset('assets/img/chungobank.png') }}">

            <h4>Chungobank Investments & Trusts</h4>
        </header>
        <nav>
            <div><a href="{{ url('gestion') }}">Gestión comercial</a></div>

            <div><a href="{{ url('alta-mto-puntos') }}">Cuenta Puntos</a> |

            <a href="{{ url('alta-personas') }}">Alta personas</a>

            </div>
        </nav>
        <h4 class='center'>@yield('header')</h4>
        <section>
            @yield('content')
        </section>
    </div>
</body>

</html>

