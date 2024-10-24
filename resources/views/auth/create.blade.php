@extends('templates.base')

@section('title', 'Agregar Usuario')
    
@section('contenido')
    <h1>Agregar Usuario</h1>

    @if ($errors->any())
        <div class="error" id="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="campo">
            <label for="name">Nombre de Usuario</label>
            <input type="text" placeholder="Ingresa el nombre del usuario..." name="name" id="name" required>
        </div>

        <div class="campo">
            <label for="email">Correo Electronico</label>
            <input type="email" placeholder="Ingresa el correo del proveedor..." name="email" id="email" required>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="campo">
            <label for="password2">Confirmar Contraseña</label>
            <input type="password" name="password2" id="password2" required>
        </div>

        <div class="campo">
            <label for="rol">Privilegio de Usuario</label>
            <select name="rol" id="rol" required>
                <option value="">Seleccione un privilegio...</option>
                @foreach ($roles as $rol => $id)
                    <option value="{{ $id }}">{{ $rol }}</option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="imagen">Foto de Perfil</label>
            <input type="file" name="perfil">
        </div>

        <div class="botones">
            <button type="submit">Agregar Usuario</button>
            <a href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>

    </form>
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

@section('styles')
    
    <style>

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
            cursor: pointer;
        }

        .botones button:hover {
            background-color: #66886d;

        }

        .botones select option {
            padding: 0.25rem;
            text-align: center;
        }

        .botones a {
                margin-bottom: 20px;
                padding: 1rem;
                background-color: var(--gris-verde-2);
                color: #494949;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
                text-decoration: none;
                text-align: center;
            }

        .botones a:hover {
            background-color: #a8b3a2;

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

            .botones a {
                margin-bottom: 20px;
                width: fit-content;
                padding: 1rem;
                background-color: var(--gris-verde-2);
                color: #494949;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
                text-decoration: none;
            }

            .botones a:hover {
                background-color: #a8b3a2;

            }

            .botones {
                width: 100%;
                flex-direction: row;
            }
        }

    </style>

@endsection