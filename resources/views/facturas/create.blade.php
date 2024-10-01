@extends('templates.base')

@section('title', 'Registrar Factura')

@section('contenido')

    <h1>Registro de Facturas</h1>

    @if ($errors->any())
        <div id="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <div class="campo">
            <label for="fechaFactura">Fecha Factura</label>
            <input type="date" name="fechaFactura" id="fechaFactura" min="2024-09-01" max="{{ now()->toDateString('Y-m-d') }}" required>
        </div>
        <br>
        <div class="campo">
            <label for="facturador">Facturador</label>
            <input type="text" placeholder="Ingresa el nombre de quien factura..." name="facturador" id="facturador">
        </div>
        <br>
        <div class="campo">
            <label for="totalFactura">Total de Factura</label>
            <input type="number" step="0.01" placeholder="Ingresa valor de la factura..." name="totalFactura" id="totalFactura" required>
        </div>
        <br>
        <div class="campo">
            <label for="idProveedor">Proveedor</label>
            <select name="idProveedor" id="idProveedor" required>
                <option value="">-- Seleccione un Proveedor --</option>
                @foreach ($proveedores as $nombreProveedor => $id)
                    <option value="{{ $id }}"> {{ $nombreProveedor }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Registrar Factura</button>
        <a href="{{ route('facturas.index') }}">Cancelar</a>
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