@extends('templates.base')

@section('titulo', 'Detalle de Factura')
    
@section('contenido')
    <h1>Detalle de Factura</h1>
    <p>{{ $factura->fechaFactura }}</p>
    <p>{{ $factura->facturador }}</p>
    <p>{{ $factura->totalFactura }}</p>
    <p>{{ $factura->estadoFactura }}</p>
    <p>{{ $factura->idProveedor }}</p>

    <h2>Detalle de Pagos realizados</h2>
    @foreach ($pagosFactura as $pago)
        <p>{{ $pago->pagoRealizado }}</p>
        <p>{{ $pago->created_at }}</p>     
    @endforeach

    <a href="{{ route('facturas.index') }}">Regresar</a>

@endsection