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
                    <option value="{{ $factura->id }}"> --Fecha: {{$factura->fechaFactura}} -- Total: ${{$factura->totalFactura}} -- </option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="campo">
            <label>Deuda restante ($)</label>
            <input type="number" value="0" id="deuda" disabled>
        </div>
        <br>
        <div class="campo">
            <label for="pagoRealizado">Pago Realizado</label>
            <input type="number" step="0.01" min="0.01" placeholder="Ingresa el monto a pagar..." name="pagoRealizado" id="pagoRealizado" required>
        </div>
        <br><br>
        <button type="submit">Registrar Pago</button>
        <a href="{{ route('pagos.index') }}">Cancelar</a>
    </form>

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
                pagoRealizado.setAttribute('max', factura.totalFactura);
                console.log("Primer Registro:", factura);
            }else{
                let factura = data1.find(f=> f.id === Number(seleccion));
                if (!factura){
                    factura = data2.find(f => f.id === Number(seleccion));
                    deuda.value = factura.totalFactura;
                    pagoRealizado.setAttribute('max', factura.totalFactura);
                    console.log("Factura con deuda total:",factura);
                }else {
                    let resta = (factura.totalFactura - factura.totalPagado);
                    deuda.value = resta;
                    pagoRealizado.setAttribute('max', resta);
                    console.log("Sepa:",factura);
                }
            }
        });

    </script>
@endsection