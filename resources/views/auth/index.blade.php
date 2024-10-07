@extends('templates.base')

@section('title', 'Listado de usuarios')

@section('contenido')
    <div class="card-titulo">
        <h1>Usuarios del Sistema</h1>

        <form action="{{ route('buscarUsuario') }}" method="GET" class="filtros">
            <div class="campos-filtro">
                <div class="campo">
                    <input type="text" name="usuario" placeholder="Ingrese el nombre del usuario...">
                </div>
                <div class="campo">
                    <select name="estado" id="estado">
                        <option value="">Seleccione un estado...</option>
                        <option value="1">Habilitado</option>
                        <option value="0">Deshabilitado</option>
                    </select>
                </div>
                <div class="campo">
                    <select name="rol" id="rol">
                        <option value="">Seleccione un privilegio...</option>
                        @foreach ($roles as $rol => $id)
                            <option value="{{ $id }}">{{ $rol }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="btn-filtros">
                <button type="submit">Buscar</button>
                <a class="limpiar" href="{{ route('usuarios.index')}}">Limpiar</a>
                <a class="crear-proveedor" href="{{ route('usuarios.create') }}">Crear Usuario</a>
            </div>
        </form>
        
    </div>

    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>Nombre de Usuario</td>
                <td>Correo Electronico</td>
                <td>Estado</td>
                <td>Privilegios</td>
                <td>Acciones</td>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr class="table-row">
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if ($usuario->estado == 1)
                            <form action="{{ route('cambiarEstado', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="habilitado">
                                    Habilitado
                                </button>
                            </form>
                        @endif
                        @if ($usuario->estado == 0)
                            <form action="{{ route('cambiarEstado', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="deshabilitado">
                                    Deshabilitado
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $usuarios->links('pagination::default') }}

@endsection

@section('styles')

    <style>

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

        .campo input[type="text"]{
            padding: 0.5rem;
            border-radius: 2px;
            border: 1px solid #b6b6b6;
            font-size: 20px;
            width: 300px;
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


        .btn-filtros button[type="submit"] {
            background-color: var(--verde-claro);
            border: 0;
            font-size: 20px;
            font-weight: 700;
            border-radius: 4px;
            color: #ffffff;
            padding: 0.75rem;
            transition: background-color 500ms ease-out;
            cursor: pointer;
        }

        .btn-filtros button[type="submit"]:hover {
            background-color: #6d9776;
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

        .habilitado {
            background-color: #6d9776;
            color: #fff;
            border: 0;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 600;
            padding: 0.5rem;
            border-radius: 2px;
        }

        .deshabilitado {
            background-color: #db3e3e;
            color: #fff;
            border: 0;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 600;
            padding: 0.5rem;
            border-radius: 2px;
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