<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <div class="login">
        <div class="titulo">
            <h1>Crear Cuenta</h1>
        </div>

        <form action="{{ route('guardarRegistro') }}" method="POST">
            @csrf
            <div>
                <label>Nombre:</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label>Correo Electronico:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Contraseña:</label>
                <input type="password" name="password" min="8" required>
            </div>
            <div>
                <label>Confirmar Contraseña:</label>
                <input type="password" name="password2" min="8" required>
            </div>
            <button type="submit">Registrarme</button>
            <a class="registrarse" href="{{ route('mostrarLogin') }}">Cancelar</a>
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