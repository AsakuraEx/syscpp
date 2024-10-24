@extends('templates.base')

@section('title', 'Facturas')

@section('contenido')
    
    <div class="card-titulo">
        <h1>Facturas</h1>

        <form action="{{ route('buscarFactura') }}" method="GET" class="filtros">
            <div class="campos-filtro">
                <div class="campo">
                    <label for="idProveedor">Proveedor</label>
                    <select name="idProveedor" id="idProveedor">
                        <option value="">Seleccione un proveedor...</option>
                        @foreach ($proveedores as $nombreProveedor => $id)
                            <option value="{{$id}}" {{ request('idProveedor') == $id ? 'selected' : '' }}>{{$nombreProveedor}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="campo">
                    <label for="estadoFactura">Estado de Factura</label>
                    <select name="estadoFactura" id="estadoFactura">
                        <option value="">Seleccione un estado...</option>
                        <option value="Sin Pagar" {{ request('estadoFactura') == 'Sin Pagar' ? 'selected' : '' }}>Sin Pagar</option>
                        <option value="Pagado Parcialmente" {{ request('estadoFactura') == 'Pagado Parcialmente' ? 'selected' : '' }}>Pagado Parcialmente</option>
                        <option value="Pagado" {{ request('estadoFactura') == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha de Factura</label>
                    <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}">
                </div>

            </div>

            <input type="hidden" name="accion" id="accion" value="buscar">

            <div class="btn-filtros">
                <button class="buscar" type="submit" id="buscar" onclick="document.getElementById('accion').value='buscar'">Buscar</button>
                <a class="limpiar" href="{{ route('facturas.index')}}">Limpiar</a>
                <a class="crear-factura" href="{{ route('facturas.create') }}">Agregar Factura</a>
                <button class="pdf" type="submit" id="pdf" onclick="document.getElementById('accion').value='pdf'">
                    <i class="bi bi-filetype-pdf"></i>
                    PDF
                </button>
            </div>
        </form>


    </div>

    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>Fecha Factura</td>
                <td>Facturador</td>
                <td>Total de Factura</td>
                <td>Estado Factura</td>
                <td>Proveedor</td>
                <td>Acciones</td>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                <tr class="table-row">
                    <td>{{ $factura->fechaFactura }}</td>
                    <td>{{ $factura->facturador }}</td>
                    <td>${{ number_format($factura->totalFactura, 2, '.', ',') }}</td>
                    <td>
                        <div class="estado">
                            {{ $factura->estadoFactura }}
                        </div>
                    </td>
                    <td>{{ $factura->nombreProveedor }}</td>
                    <td>
                        @if ($factura->estadoFactura == 'Sin Pagar')
                            <a href="{{ route('facturas.edit', $factura->id) }}">
                                <button class="editar">Editar</button>
                            </a>
                            <form action="{{ route('facturas.destroy', $factura->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="eliminar">Eliminar</button>
                            </form>                            
                        @endif
                        @if ($factura->estadoFactura != 'Sin Pagar')
                            <a href="{{ route('facturas.show', $factura->id) }}">
                                <button class="detalle">Detalle</button>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{ $facturas->links('pagination::default') }}

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

        .estado{
            background-color: #4c8fc3;
            width: 200px;
            padding: 0.5rem;
            border-radius: 30px;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            margin-right: auto;
            margin-left: auto;
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

        .detalle{
            text-decoration: none;
            background-color: #4c8fc3;
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

        .detalle:hover {
            background-color: #2f6996;
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

        .crear-factura{
            text-decoration: none;
            background-color: var(--verde-semioscuro);
            color: #ffffff;
            font-weight: 700;
            font-size: 20px;
            padding: 0.75rem;
            border-radius: 4px;
            height: 24px;
            transition: background-color 500ms ease-out;
        }

        .crear-factura:hover{
            background-color: #536a6d;

        }

        .pagar:hover{
            background-color: #536a6d;

        }


        .buscar {
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

        .buscar:hover {
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

            .crear-factura{
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

@section('scripts-2')
    
    <script>

        var estados = document.getElementsByClassName("estado");
        for(var i = 0; i < estados.length; i++){
            var estado = estados[i].innerText;
            if(estado === "SIN PAGAR"){
                estados[i].style.backgroundColor = "red";
            }else if (estado === "PAGADO PARCIALMENTE"){
                estados[i].style.backgroundColor = "orange";
            }else {
                estados[i].style.backgroundColor = "green"
            }
        }

    </script>

@endsection