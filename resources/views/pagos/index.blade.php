@extends('templates.base')

@section('titulo', 'Listado de Pagos')
    
@section('contenido')

    <div class="card-titulo">
        <h1>Listado de Pagos</h1>

        <form action="{{ route('buscarPago') }}" method="GET" class="filtros">
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
                    <label for="fechaFactura">Fecha de Factura</label>
                    <input type="date" name="fechaFactura" id="fechaFactura" value="{{ request('fechaFactura') }}">
                </div>

                <div class="campo">
                    <label for="fechaPago">Fecha de Pago</label>
                    <input type="date" name="fechaPago" id="fechaPago" value="{{ request('fechaPago') }}">
                </div>
            </div>

            <input type="hidden" name="accion" id="accion" value="buscar">

            <div class="btn-filtros">
                <button class="buscar" id="buscar" type="submit" onclick="document.getElementById('accion').value='buscar'">Buscar</button>
                <a class="limpiar" href="{{ route('pagos.index')}}">Limpiar</a>
                <a class="pagar" href="{{ route('pagos.create') }}">Pagar</a>
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
                <td>Fecha de Factura</td>
                <td>Proveedor</td>
                <td>Total Factura</td>
                <td>Pago Realizado</td>
                <td>Deuda Restante</td>
                <td>Fecha de Pago</td>
                <td>Acciones</td>
            </thead>
            <tbody>
                @foreach ($pagos as $pago)
                    <tr class="table-row">
                        <td>{{ $pago->fechaFactura }}</td>
                        <td>{{ $pago->nombreProveedor }}</td>
                        <td>${{ number_format($pago->totalFactura, 2, '.',',') }}</td>
                        <td>${{ number_format($pago->pagoRealizado, 2, '.', ',') }}</td>
                        <td>
                            $
                            @foreach ($pagosTotales as $total)
                            {{ ($total->idFactura == $pago->idFactura ? number_format(($pago->totalFactura - $total->totalPagado),2,'.',',') : "") }}                              
                            @endforeach

                        </td>
                        <td>{{ $pago->updated_at }}</td>
                        <td>
                            @if ($pago->estadoFactura != 'Pagado')
                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="eliminar">Cancelar Pago</button>
                            </form>                            
                        @endif
                        </td>
                    </tr>                
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $pagos->links('pagination::default') }}

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

        .pagar{
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

        .pagar:hover{
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
        }

        .detalle:hover {
            background-color: #2f6996;
        }

        .eliminar{
            text-decoration: none;
            background-color: #c34c4c;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            padding: 0.5rem;
            border-radius: 4px;
            width: 120px;           
            transition: background-color 500ms ease-out;
            border: 0;
            cursor: pointer;
        }

        .eliminar:hover {
            background-color: #a53737;
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
            .btn-filtros button[type="submit"]{
                width: 200px;
            }
            .pagar{
                width: 200px;
            }
            .limpiar{
                width: 200px;
            }
        }

    </style>
    
    
@endsection