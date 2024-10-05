@extends('templates.base')
@section('titulo', 'Ranking de Proveedores')

@section('contenido')
    <h1>Los 10 mejores proveedores de NONG</h1>

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
                    <td>{{ (($item->totalFacturas / $totalFacturas)*100) }}%</td>
                </tr>                
                @endforeach
    
            </tbody>
        </table>
    </div>

@endsection

@section('styles')
    <style>
        .tabla {
            overflow-x: auto;
        }

        h1 {
            color:#84a98c;
            border-bottom: 4px solid;
            border-color: #84a98c;
            margin-bottom: 2rem;
            padding-bottom: 8px;
            font-weight: 900;
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

        .table-row td{
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #000;
        }

    </style>
@endsection