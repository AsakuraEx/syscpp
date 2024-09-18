<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
        <!-- Styles -->
        @yield('styles')

        <!-- Scripts -->
        @yield('scripts-1')
        <script src="{{ asset('js/navbar.js') }}"></script>

    </head>
    <body>
        <nav class="navbar">
            <button 
                class="btn-menu" 
                onclick="mostrarMenu()"
                id="btn-menu"
            >
                <i class="bi bi-list"></i>
            </button>
    
            <a href="index.html">
                <img 
                    src="/images/logo.png" 
                    alt="Logo" 
                    class="logo"
                >
            </a>
            
            <button class="dropdown" id="dropdown">
                <span>
                    Francisco Escobar
                </span>
                <i class="bi bi-gear"></i>
    
            </button>
        </nav>
    
        <div id="fondo-oscuro">
    
        </div>
    
        <div 
            class="navmenu" 
            id="navmenu"
            onclick="mostrarMenu()"
        >
            <div class="navitems" id="navitems">
                <div class="perfil">
                    <img src="images/foto-perfil.webp" alt="perfil" class="foto-perfil">
                    <p>Francisco Josue Escobar</p>
                    <span>Administrador</span>
                </div>
                <div class="menu">
                    <a href="#">
                        <i class="bi bi-house"></i>
                        Dashboard
                    </a>
                    <a href="#">
                        <i class="bi bi-journal"></i>
                        Facturas
                    </a>
                    <a href="#">
                        <i class="bi bi-file-earmark"></i>
                        Reportes
                    </a>
                </div>
            </div>
        </div>
    
        <main class="contenido">
            @yield('contenido')
        </main>

        <footer>
            @yield('footer')
        </footer>


    </body>
    <!-- Scripts -->
    @yield('scripts-2')

</html>
