@extends('templates.pdf_view')

@section('titulo', 'Facturas Emitidas')

@section('tabla')
    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>Fecha Factura</td>
                <td>Facturador</td>
                <td>Total de Factura</td>
                <td>Estado Factura</td>
                <td>Proveedor</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection