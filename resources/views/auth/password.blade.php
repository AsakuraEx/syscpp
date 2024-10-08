@extends('templates.base')

@section('title', 'Cambio de Contraseña')
    
@section('contenido')
    <h1>{{ Auth::user()->name }} está a punto de realizar el cambio de su contraseña</h1>

    <form action="{{ route('usuarios.changePassword') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="campo">
            <input type="password" min="8" name="oldpassword" placeholder="Ingresa la contraseña anterior..." required>
        </div>
        <div class="campo">
            <input type="password" min="8" name="password" placeholder="Ingresa la nueva contraseña..." required>
        </div>
        <div class="campo">
            <input type="password" min="8" name="password2" placeholder="Repite la nueva contraseña..." required>
        </div>
        <div class="botones">
            <button type="submit">Cambiar Contraseña</button>
        </div>

    </form>

    @if ($errors->any())
        <div class="error" id="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('styles')
    
    <style>

        .error {
            color: #ac1d1d;
            background-color: #f39c9c;
            border: 1px solid #ac1d1d;
            text-align: center;
            padding: 1rem;
            border-radius: 20px;
            margin: 0 10px;
        }

        h1 {
            color:var(--verde-semioscuro);;
            border-bottom: 4px solid;
            border-color: var(--verde-semioscuro);
            margin-bottom: 2rem;
            padding-bottom: 8px;
            font-weight: 900;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .campo {
            display: inline-flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            width: 100%
        }

        .botones {
            display: inline-flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            width: 100%
        }

        .campo label {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .campo input {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
        }

        .campo select {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
        }

        .botones button {
            margin-bottom: 20px;
            padding: 1rem;
            background-color: var(--verde-claro);
            color: white;
            font-weight: 700;
            font-size: 16px;
            border: 0;
            border-radius: 2px;  
        }

        .botones button:hover {
            background-color: #66886d;

        }

        @media screen and (min-width: 720px){
            form {
                display: inline-flex;
                flex-direction: column;
                gap: 12px;
                flex-wrap: wrap;
            }

            form div {
                display: flex;
                flex-direction: row;
                gap: 12px;
                justify-content: center;
            }

            .campo{
                width: 100%;
            }

            .campo input {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            }

            .botones button {
                margin-bottom: 20px;
                width: fit-content;
                padding: 1rem;
                background-color: var(--verde-claro);
                color: white;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
            }

            .botones button:hover {
                background-color: #66886d;

            }

            .botones {
                width: 100%;
                flex-direction: row;
            }
        }

    </style>

@endsection

@section('scripts-1')
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
@endsection