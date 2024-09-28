@extends('templates.base')

@section('title', 'Proveedores')

@section('contenido')
    <h1>Proveedores</h1>

    <a href="{{ route('proveedores.create') }}">Crear Proveedor</a>

    <br><br>

    <table border>
        <thead>
            <td>Nombre del Proveedor</td>
            <td>Telefono del Proveedor</td>
            <td>Correo del Proveedor</td>
            <td>Acciones</td>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->nombreProveedor }}</td>
                <td>{{ $proveedor->telefonoProveedor }}</td>
                <td>{{ $proveedor->correoProveedor }}</td>
                <td>
                    <br>
                    <a href="{{ route('proveedores.edit', $proveedor->id) }}">
                        Editar
                    </a>
                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $proveedores->links() }}
@endsection