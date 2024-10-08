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
            <div class="error" id="error">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el elemento del mensaje flash
            var flashMessage = document.getElementById('error');

            // Si el mensaje existe, configúralo para desaparecer después de 5 segundos
            if(flashMessage) {
                setTimeout(function() {
                    flashMessage.style.transition = "opacity 0.5s ease";  // Suavizar la desaparición
                    flashMessage.style.opacity = 0;  // Desvanecer el mensaje
                    setTimeout(() => flashMessage.remove(), 500);  // Eliminar el elemento después de desvanecerse
                }, 3000);  // 5000 ms = 5 segundos
            }
        });
    </script>

</body>
</html>