
@extends('templates.base')

@section('title', 'Dashboard')

@section('contenido')
     @if (Hash::check(123,Auth::user()->password))
        <div class="msj">
            Se recomienda cambiar la <b>contraseña de usuario</b>, por favor utilice la 
            opción <b>Cambiar Contraseña</b> ubicada en la parte superior derecha de la pantalla, sobre el icono de engranaje.
        </div>  
     @endif

    <div class="portada">
        <h1 class="titulo-logo">SYSCPP</h1>
        <img src="/images/logo.png" alt="logo">
        <h1 class="eslogan">Generando valor a tu economia</h1>
        <h1 class="eslogan">Organizacion NONG &copy; 2024</h1>
    </div>


@endsection

@section('styles')
    
    <style>

        .principal {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
        }

        .msj {
            color: #ac1d1d;
            background-color: #f39c9c;
            border: 1px solid #ac1d1d;
            text-align: center;
            padding: 1rem;
            border-radius: 20px;
            position: absolute;
            top: 20px;
            margin: 0 10px;
        }

        .portada {
            text-align: center;

        }

        .titulo-logo {
            font-size: 64px;
            font-weight: 700;
            color: #354f52;
            margin: 0;
            padding: 0;
        }

        .portada img {
            height: 20rem;
            margin: 0;
            padding: 0;
        }

        .eslogan {
            font-weight: 500;
            color: #354f52;
            font-size: 32px;
            text-transform: uppercase;
        }
    </style>


@endsection