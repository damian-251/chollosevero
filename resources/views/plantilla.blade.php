<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <title>@yield('titulo')</title>
</head>
<body>
    <header>

        <div class="titulo"><img src={{ asset('./assets/images/logo.png') }} alt="logo"> Chollo ░▒▓ Severo</div>
        <nav>
            <ul>
                <li> <a href={{ route('inicio') }}>Inicio</a></li>
                <li> <a href={{ route('novedades') }}>Nuevos</a></li>
                <li><a href={{ route('destacado') }}>Destacados</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('contenidoMain')    
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </main>
    <footer>
        Damián Martín <br>
        ©<?=date("Y")?> Chollosevero. ©1995 - <?=date("Y")?>
    </footer>
</body>
</html>