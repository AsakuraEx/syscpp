<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <div class="login">
        <div class="titulo">
            <h1>SYSCPP</h1>
            <h6>Inicio de Sesión</h6>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label>Correo Electronico:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Contraseña:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
            <a class="registrarse" href="{{ route('registrarse') }}">Registrate</a>
        </form>
    </div>




    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>