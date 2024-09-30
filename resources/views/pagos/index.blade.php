@extends('templates.base')

@section('titulo', 'Listado de Pagos')
    
@section('contenido')

    <div class="card-titulo">
        <h1>Listado de Pagos Realizados</h1>
        <a href="{{ route('pagos.create') }}">Realizar Pago</a>
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
            justify-content: space-between;
            align-items: center;
        }

        .card-titulo h1{
            color: var(--verde-medio);
        }

        .card-titulo a{
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

        .card-titulo a:hover{
            background-color: #536a6d;

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
        }

        .eliminar:hover {
            background-color: #a53737;
        }

    </style>
    
    
@endsection