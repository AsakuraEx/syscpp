@extends('templates.base')

@section('titulo', 'Listado de Pagos')
    
@section('contenido')

    <h1>Registro de pago</h1>

    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf
        <div class="campo">
            <label for="idFactura">Factura</label>
            <select name="idFactura" id="idFactura" required>
                <option value="">-- Seleccione una factura --</option>
                @foreach ($facturasSinPagar as $factura)
                    <option value="{{ $factura->id }}"> --Fecha: {{$factura->fechaFactura}} -- Total: ${{$factura->totalFactura}} -- Proveedor: {{$factura->nombreProveedor}} -- Facturador: {{ $factura->facturador }} --</option>
                @endforeach
            </select>
        </div>

        <div>
            <div class="campo">
                <label>Deuda restante ($)</label>
                <input type="number" value="0" id="deuda" disabled>
            </div>
    
            <div class="campo">
                <label for="pagoRealizado">Pago Realizado</label>
                <input type="number" step="0.01" min="0.01" placeholder="Ingresa el monto a pagar..." name="pagoRealizado" id="pagoRealizado" required>
            </div>
        </div>
    
        <div class="botones">
            <button type="submit">Registrar Pago</button>
            <a href="{{ route('pagos.index') }}">Cancelar</a>
        </div>

    </form>

@endsection

@section('styles')
    
    <style>

        h1 {
            color:var(--verde-semioscuro);;
            border-bottom: 4px solid;
            border-color: var(--verde-semioscuro);
            margin-bottom: 2rem;
            padding-bottom: 8px;
            font-weight: 900;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .campo {
            display: inline-flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            width: 100%
        }

        .botones {
            display: inline-flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
            width: 100%
        }

        .campo label {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .campo input {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
        }

        .campo select {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
        }

        .botones button {
            margin-bottom: 20px;
            padding: 1rem;
            background-color: var(--verde-claro);
            color: white;
            font-weight: 700;
            font-size: 16px;
            border: 0;
            border-radius: 2px;  
        }

        .botones button:hover {
            background-color: #66886d;

        }

        .botones select option {
            padding: 0.25rem;
            text-align: center;
        }

        .botones a {
                margin-bottom: 20px;
                padding: 1rem;
                background-color: var(--gris-verde-2);
                color: #494949;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
                text-decoration: none;
                text-align: center;
            }

        .botones a:hover {
            background-color: #a8b3a2;

        }

        @media screen and (min-width: 720px){
            form {
                display: inline-flex;
                flex-direction: column;
                gap: 12px;
                flex-wrap: wrap;
            }

            form div {
                display: flex;
                flex-direction: row;
                gap: 12px;
                justify-content: center;
            }

            .campo{
                width: 100%;
            }

            .campo input {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 12px;
            padding: 0.65rem;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            }

            .campo select {
                font-weight: 500;
                font-size: 16px;
                margin-bottom: 12px;
                padding: 0.65rem;
                border: 1px solid #d9d9d9;
                border-radius: 4px;
                width: 100%;
            }

            .botones button {
                margin-bottom: 20px;
                width: fit-content;
                padding: 1rem;
                background-color: var(--verde-claro);
                color: white;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
            }

            .botones button:hover {
                background-color: #66886d;

            }

            .botones a {
                margin-bottom: 20px;
                width: fit-content;
                padding: 1rem;
                background-color: var(--gris-verde-2);
                color: #494949;
                font-weight: 700;
                font-size: 16px;
                border: 0;
                border-radius: 2px;  
                text-decoration: none;
            }

            .botones a:hover {
                background-color: #a8b3a2;

            }

            .botones {
                width: 100%;
                flex-direction: row;
            }
        }

    </style>

@endsection

@section('scripts-2')
    <script>
        const idFactura = document.getElementById("idFactura");
        const deuda = document.getElementById("deuda");
        const pagoRealizado = document.getElementById("pagoRealizado");
        const data1 = @json($facturas);
        const data2 = @json($facturasSinPagar);
        
        idFactura.addEventListener('change', function(){
            const seleccion = idFactura.value;
            if(data1.length === 0){
                let factura = data2.find(f => f.id === Number(seleccion));
                deuda.value = factura.totalFactura;
                pagoRealizado.setAttribute('max', factura.totalFactura.toFixed(2));
                console.log("Primer Registro:", factura);
            }else{
                let factura = data1.find(f=> f.id === Number(seleccion));
                if (!factura){
                    factura = data2.find(f => f.id === Number(seleccion));
                    deuda.value = factura.totalFactura;
                    pagoRealizado.setAttribute('max', factura.totalFactura.toFixed(2));
                    console.log("Factura con deuda total:",factura);
                }else {
                    let resta = (factura.totalFactura - factura.totalPagado);
                    deuda.value = resta;
                    pagoRealizado.setAttribute('max', resta.toFixed(2));
                    console.log("Sepa:",factura);
                }
            }
        });

    </script>
@endsection