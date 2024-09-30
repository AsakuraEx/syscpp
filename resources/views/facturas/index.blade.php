@extends('templates.base')

@section('title', 'Facturas')

@section('contenido')
    
    <div class="card-titulo">
        <h1>Facturas</h1>
        <a href="{{ route('facturas.create') }}">Agregar Facturas</a>
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