<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @yield('styles')

        <!-- Scripts -->
        @yield('scripts-1')
    </head>
    <body>
        <header>
            <h1>SYSCPP - Tecnología Orientada a Objectos 2024 &copy;</h1>
            <h2>Header de base.blade.php</h2>
            @yield('header')
        </header>

        <main>
            @yield('main')
        </main>

        <footer>
            @yield('footer')
        </footer>


    </body>
    <!-- Scripts -->
    <script>
        @yield('scripts-2')
    </script>

</html>
