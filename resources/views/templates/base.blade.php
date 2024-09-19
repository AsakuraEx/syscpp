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
            <div class="drop" id="dropdown">
                <button class="dropdown" onclick="dropdownMenu()">
                    <span>
                        Francisco Escobar
                    </span>
                    <i class="bi bi-gear"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#">
                        <i class="bi bi-pencil-fill"></i>
                        Cambiar Contraseña
                    </a>
                    <a href="#">
                        <i class="bi bi-box-arrow-left"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
    
        </nav>
    
        <div id="fondo-oscuro" onclick="ocultarMenu()">
    
        </div>
    
        <div 
            class="navmenu" 
            id="navmenu"
            onclick="mostrarMenu()"
        >
            <div>
                <div class="perfil">
                    <img src="/images/foto-perfil.webp" alt="perfil" class="foto-perfil">
                    <p>Francisco Josue Escobar</p>
                    <span>Administrador</span>
                </div>
                <div class="menu">
                    <a href="#">
                        <i class="bi bi-house"></i>
                        Dashboard
                    </a>
                    <a href="#">
                        <i class="bi bi-person-plus-fill"></i>
                        Proveedores
                    </a>
                    <a href="#">
                        <i class="bi bi-journal"></i>
                        Facturas
                    </a>
                    <a href="#">
                        <i class="bi bi-file-earmark"></i>
                        Reportes
                    </a>
                    <a href="#">
                        <i class="bi bi-person-circle"></i>
                        Administración de Usuarios
                    </a>
                </div>
            </div>
        </div>
    
        <main class="contenido">
            <div class="principal">
                @yield('contenido')
            </div>
        </main>

        <footer>
            @yield('footer')
        </footer>


    </body>
    <!-- Scripts -->
    @yield('scripts-2')

</html>
