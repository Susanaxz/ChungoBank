<!DOCTYPE html>
<html>

<head>
    <title>Chungo Bank</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/css/cb.css">
    @yield('styles')
</head>

<body>
    <div class='contenedor'>
        <header>
            <img src="assets/img/chungobank.png">
            <h4>Chungobank Investments & Trusts</h4>
        </header>
        <nav>
            <div><a href="gestion">Gestión comercial</a></div>
            <div><a href="alta-mto-puntos">Cuenta Puntos</a> |
                <a href="alta-personas">Alta personas</a>
            </div>
        </nav>
        <h4 class='center'>@yield('header')</h4>
        <section>
            @yield('content')
        </section>
    </div>
</body>

</html>
