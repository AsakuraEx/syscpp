@extends('templates.pdf_view')

@section('titulo', 'Proveedores Registrados')

@section('tabla')
    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>Nombre del Proveedor</td>
                <td>Telefono del Proveedor</td>
                <td>Correo del Proveedor</td>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                <tr class="table-row">
                    <td>{{ $proveedor->nombreProveedor }}</td>
                    <td>{{ $proveedor->telefonoProveedor }}</td>
                    <td>{{ $proveedor->correoProveedor }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection