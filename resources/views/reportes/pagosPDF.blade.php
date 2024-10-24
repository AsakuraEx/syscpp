@extends('templates.pdf_view')

@section('titulo', 'Pagos Realizados')

@section('tabla')
<div class="tabla">
    <table cellspacing="0">
        <thead class="table-head">
            <td>Fecha de Factura</td>
            <td>Proveedor</td>
            <td>Total Factura</td>
            <td>Pago Realizado</td>
            <td>Deuda Restante</td>
            <td>Fecha de Pago</td>
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
                </tr>                
            @endforeach
        </tbody>
    </table>
</div>
@endsection