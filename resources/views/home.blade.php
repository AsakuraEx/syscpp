
@extends('templates.base')

@section('title', 'Dashboard')

@section('contenido')
    
    <div class="portada">
        <h1 class="titulo-logo">SYSCPP</h1>
        <img src="/images/logo.png" alt="logo">
        <h1 class="eslogan">Generando valor a tu economia</h1>
        <h1 class="eslogan">Organizacion NONG &copy; 2024</h1>
    </div>


@endsection

@section('styles')
    
    <style>
        .portada {
            text-align: center;
            margin-top: 10%;
            margin-bottom: auto;
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