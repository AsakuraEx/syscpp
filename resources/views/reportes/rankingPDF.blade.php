@extends('templates.pdf_view')

@section('titulo', 'Ranking de Proveedores')

@section('tabla')
    <div class="tabla">
        <table cellspacing="0">
            <thead class="table-head">
                <td>#</td>
                <td>Proveedor</td>
                <td>Total de Facturas</td>
                <td>Porcentaje total de Facturas</td>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="table-row">
                    <td>{{ $contador++ }}</td>
                    <td>{{ $item->nombreProveedor }}</td>
                    <td>{{ $item->totalFacturas }} facturas</td>
                    <td>{{ number_format((($item->totalFacturas / $totalFacturas)*100),2,'.',',') }}%</td>
                </tr>                
                @endforeach

            </tbody>
        </table>
    </div>    
@endsection