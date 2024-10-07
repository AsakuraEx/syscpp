<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>

    <div class="login">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="titulo">
            <h1>SYSCPP</h1>
            <h6>Inicio de Sesión</h6>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <box-icon type='solid' name='user'></box-icon>
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required>
                <box-icon name='lock-alt' type='solid' ></box-icon>
            </div>
            <div class="botones">
                <button type="submit">Iniciar Sesión</button>
            </div>

        </form>
    </div>


</body>
</html>