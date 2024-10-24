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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
        <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
        <link rel="shortcut icon" href="{{ asset('temp/icons/aprobado-2.png') }}" type="image/x-icon">

        <!-- Styles -->
        @yield('styles')

        <!-- Scripts -->
        @yield('scripts-1')
        <script src="{{ asset('js/navbar.js') }}"></script>

    </head>
    <body id="body">
        <nav class="navbar">
            <button 
                class="btn-menu" 
                onclick="mostrarMenu()"
                id="btn-menu"
            >
                <i class="bi bi-list"></i>
            </button>
    
            <div class="drop" id="dropdown">
                <button class="dropdown" onclick="dropdownMenu()">
                    <span>
                        {{ Auth::user()->name }}
                    </span>
                    <i class="bi bi-gear"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="{{ route('usuarios.password') }}">
                        <i class="bi bi-pencil-fill"></i>
                        Cambiar Contraseña
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="logout" type="submit">
                            <i class="bi bi-box-arrow-left"></i>
                            Cerrar Sesión
                        </button>
                    </form>
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
                    @isset(Auth::user()->img)
                        <img src="{{ Auth::user()->img }}" alt="perfil" class="foto-perfil">    
                    @endisset                
                    <p>{{ Auth::user()->name }}</p>
                    <span>
                        @if (Auth::user()->rol_type == 1)
                            ADMINISTRADOR
                        @endif
                        @if (Auth::user()->rol_type == 2)
                            MONITOREO
                        @endif
                        @if (Auth::user()->rol_type == 3)
                            ESTANDAR
                        @endif
                    </span>
                </div>
                <div class="menu">
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        Inicio
                    </a>
                    @if (Auth::user()->rol_type == 1 || Auth::user()->rol_type == 2)
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    @endif

                    <a href="{{ route('proveedores.index') }}">
                        <i class="bi bi-person-plus-fill"></i>
                        Proveedores
                    </a>
                    <a href="{{ route('facturas.index') }}">
                        <i class="bi bi-journal"></i>
                        Facturas
                    </a>
                    <a href="{{ route('pagos.index') }}">
                        <i class="bi bi-currency-dollar"></i>
                        Pagos
                    </a>
                    @if (Auth::user()->rol_type == 1 || Auth::user()->rol_type == 2)
                        <a href="{{ route('proveedores.ranking') }}">
                            <i class='bx bxs-crown'></i>
                            Ranking de Proveedores
                        </a>
                    @endif
                    @if (Auth::user()->rol_type == 1)
                        <a href="{{ route('usuarios.index') }}">
                            <i class="bi bi-person-circle"></i>
                            Administración de Usuarios
                        </a>
                    @endif
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
