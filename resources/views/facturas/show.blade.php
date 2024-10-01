@extends('templates.base')

@section('titulo', 'Detalle de Factura')
    
@section('contenido')

    <div class="tabla">
        <h3>Detalle de Factura</h3>
        <table cellspacing="0">
            <thead class="table-head">
                <td>Fecha de Factura</td>
                <td>Facturador</td>
                <td>Monto Total Facturado</td>
                <td>Proveedor</td>
                <td>Estado Actual</td>
            </thead>
            <tbody>
                <tr class="table-row">
                    <td>{{ $factura->fechaFactura }}</td>
                    <td>{{ $factura->facturador }}</td>
                    <td>${{ number_format($factura->totalFactura, 2, '.', ',') }}</td>
                    <td>{{ $factura->idProveedor }}</td>
                    <td>
                        <div class="estado">
                            {{ $factura->estadoFactura }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tabla">
        <h3>Detalle de Pagos</h3>
        <table cellspacing="0">
            <thead class="table-head">
                <td># Pago</td>
                <td>Monto Pagado</td>
                <td>Fecha y Hora Pago</td>
            </thead>
            <tbody>
                @foreach ($pagosFactura as $pago)
                    <tr class="table-row">
                        <td>{{ $i++ }}</td>
                        <td>${{ number_format($pago->pagoRealizado, 2,'.','.') }}</td>
                        <td>{{ $pago->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a class="detalle" href="{{ route('facturas.index') }}">Regresar</a>

@endsection

@section('styles')
    <style>
        .tabla {
            overflow-x: auto;
        }

        .tabla h3 {
            margin: 0;
            width: 100%;
            text-align: center;
            background-color: var(--verde-semioscuro);
            text-transform: uppercase;
            color: #fff;
            padding-bottom: 8px;
            padding-top: 12px;
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