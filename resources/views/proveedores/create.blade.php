@extends('templates.base')

@section('title', 'Crear Proveedor')

@section('contenido')

    <h1>Crear Proveedor</h1>

    @if ($errors->any())
        <div id="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <div class="campo">
            <label for="nombreProveedor">Nombre de Proveedor</label>
            <input type="text" placeholder="Ingresa el nombre del proveedor..." name="nombreProveedor" id="nombreProveedor">
        </div>
        <br>
        <div class="campo">
            <label for="telefonoProveedor">Teléfono de Proveedor</label>
            <input type="text" placeholder="Ingresa el telefono del proveedor..." name="telefonoProveedor" id="telefonoProveedor">
        </div>
        <br>
        <div class="campo">
            <label for="correoProveedor">Correo de Proveedor</label>
            <input type="email" placeholder="Ingresa el correo del proveedor..." name="correoProveedor" id="correoProveedor">
        </div>
        <br>
        <button type="submit">Agregar Proveedor</button>
        <a href="{{ route('proveedores.index') }}">Cancelar</a>
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