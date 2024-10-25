@extends('templates.base')

@section('title', 'Proveedores')

@section('contenido')

    <div class="card-titulo">
        <h1>Proveedores</h1>

        <form action="{{ route('buscarProveedor') }}" method="GET" class="filtros">
            <div class="campos-filtro">
                <div class="campo">
                    <input type="text" name="proveedor" placeholder="Ingrese un proveedor" id="proveedor" value="{{request('proveedor')}}">
                </div>

            </div>

            <input type="hidden" name="accion" id="accion" value="buscar">

            <div class="btn-filtros">
                <button class="buscar" id="buscar" type="submit" onclick="document.getElementById('accion').value='buscar'">Buscar</button>
                <a class="limpiar" href="{{ route('proveedores.index')}}">Limpiar</a>
                @if (Auth::user()->rol_type != 2)
                    <a class="crear-proveedor" href="{{ route('proveedores.create') }}">Crear Proveedor</a>
                @endif

                @if (Auth::user()->rol_type != 3)
                    <button class="pdf" type="submit" id="pdf" onclick="document.getElementById('accion').value='pdf'">
                        <i class="bi bi-filetype-pdf"></i>
                        PDF
                    </button>
                @endif
            </div>
        </form>
        
    </div>

    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>Nombre del Proveedor</td>
                <td>Telefono del Proveedor</td>
                <td>Correo del Proveedor</td>
                <td>Acciones</td>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                <tr class="table-row">
                    <td>{{ $proveedor->nombreProveedor }}</td>
                    <td>{{ $proveedor->telefonoProveedor }}</td>
                    <td>{{ $proveedor->correoProveedor }}</td>
                    <td>
                        @if (Auth::user()->rol_type != 2)
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}">
                                <button class="editar">Editar</button>
                            </a>
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="eliminar"  type="submit">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $proveedores->links('pagination::default') }}
@endsection

@section('styles')

    <style>

        .campo input[type="text"]{
            padding: 0.5rem;
            border-radius: 2px;
            border: 1px solid #b6b6b6;
            font-size: 20px;
            width: 300px;
        }

        .tabla {
            overflow-x: auto;
        }

        table{
            width: 100%;
            margin-bottom: 24px;
        }

        .table-head{
            text-align: center;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 900;
            color: #ffffff;
            background-color: var(--verde-semioscuro);
        }

        .table-head td {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .table-row {
            color: var(--verde-semioscuro);
            background-color: #ffffff;
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            transition: background-color 500ms ease;
        }

        .table-row:hover {
            background-color: #f5f7f4;
        }

        .table-row td{
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #000;
        }

        .card-titulo{
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .card-titulo h1{
            color: var(--verde-medio);
        }

        .editar{
            text-decoration: none;
            background-color: #c39d4c;
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            padding: 0.75rem;
            border-radius: 4px;
            width: 120px;
            transition: background-color 300ms ease-out;
            border: 0;
            margin-bottom: 4px;
            cursor: pointer;
        }

        .editar:hover {
            background-color: #9b7930;
        }
        
        .eliminar{
            text-decoration: none;
            background-color: #c34c4c;
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            padding: 0.75rem;
            border-radius: 4px;
            width: 120px;           
            transition: background-color 500ms ease-out;
            border: 0;
            cursor: pointer;
        }

        .eliminar:hover {
            background-color: #a53737;
        }

        .filtros{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-direction: column;
            width: 100%;
        }

        .campos-filtro {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }

        .campo select {
            padding: 0.5rem;
            border-radius: 2px;
            border: 1px solid #b6b6b6;
            font-size: 20px;
        }

        .campo input[type="date"]{
            padding: 0.5rem;
            border-radius: 2px;
            border: 1px solid #b6b6b6;
            font-size: 20px;
        }

        .btn-filtros{
            background-color: #e7e7e7;
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            gap: 12px;
        }

        .crear-proveedor{
            text-decoration: none;
            background-color: var(--verde-semioscuro);
            color: #ffffff;
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            padding: 0.75rem;
            border-radius: 4px;
            height: 24px;
            transition: background-color 500ms ease-out;
        }

        .crear-proveedor:hover{
            background-color: #536a6d;

        }

        .limpiar {
            background-color: #f1f1f1;
            border: 0;
            font-size: 20px;
            font-weight: 700;
            border-radius: 4px;
            color: #525252;
            padding: 0.75rem;
            text-decoration: none;
            transition: background-color 500ms ease-out;
        }

        .limpiar:hover {
            background-color: #fff;
        }

        @media screen and (min-width: 680px){
            .filtros{
                flex-direction: column;
            }
            .campos-filtro {
                flex-direction: row;
            }

            .btn-filtros{
                flex-direction: row;
            }

            .crear-proveedor{
                width: 200px;
            }
            .limpiar{
                width: 200px;
            }

            .btn-filtros button[type="submit"]{
                width: 200px;
            }
        }

    </style>
    
    
@endsection