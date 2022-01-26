<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <title>@yield('titulo')</title>
    <link rel="shortcut icon" href={{ asset('assets/images/favicon.ico') }} type="image/x-icon">
</head>
<body>
    <header>
        <nav class="navbar navbar-default menu-principal">
            <div class="container-fluid">
                <a class="navbar-header logo-inicio" href={{ route('inicio') }}>
                    
                    <img src={{ asset('./assets/images/logo.png') }} alt="logo">
                     Chollo ░▒▓ Severo   
                </a>
                <ul class="nav navbar-nav">
                    <li> <a href={{ route('inicio') }}>Inicio</a></li>
                    <li> <a href={{ route('novedades') }}>Nuevos</a></li>
                    <li><a href={{ route('destacado') }}>Destacados</a></li>
                    <li><a href={{ route('chollos.creacion')}}>Crear chollo</a></li>
                </ul>
            </div>
        </nav>

    </header>
    <main>
        @yield('contenidoMain')    
    </main>
    <footer>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            Damián Martín <br>
            ©<?=date("Y")?> Chollosevero. ©1995 - <?=date("Y")?>
          </div>
    
    </footer>
</body>
</html>