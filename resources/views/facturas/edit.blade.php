@extends('templates.base')

@section('title', 'Editar Factura')

@section('contenido')

    <h1>Actualizar registro de Facturas</h1>

    @if ($errors->any())
        <div id="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('facturas.update', $factura->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="campo">
            <label for="fechaFactura">Fecha Factura</label>
            <input type="date" name="fechaFactura" id="fechaFactura" value="{{ $factura->fechaFactura }}" min="2024-09-01" max="{{ $fechaActual->format("Y-m-d") }}" required>
        </div>
        <br>
        <div class="campo">
            <label for="facturador">Facturador</label>
            <input type="text" placeholder="Ingresa el nombre de quien factura..." 
            name="facturador" id="facturador" value="{{ $factura->facturador }}">
        </div>
        <br>
        <div class="campo">
            <label for="totalFactura">Total de Factura</label>
            <input type="number" step="0.01" placeholder="Ingresa el correo del proveedor..." 
            name="totalFactura" id="totalFactura" required value="{{ $factura->totalFactura }}">
        </div>
        <br>
        <div class="campo">
            <label for="idProveedor">Proveedor</label>
            <select name="idProveedor" id="idProveedor" required>
                <option value="">-- Seleccione un Proveedor --</option>
                @foreach ($proveedores as $nombreProveedor => $id)
                    <option value="{{ $id }}" {{ old('idProveedor', $factura->idProveedor) == $id ? "selected" : "" }}> {{ $nombreProveedor }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Actualizar Factura</button>
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