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
            <label>Monto Restante ($)</label>
            <input type="number" value="0" id="montoPagado" name="resto" disabled>
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
        const factura = document.getElementById("idFactura");
        const montoPagado = document.getElementById("montoPagado");
        const pagoRealizado = document.getElementById("pagoRealizado");
        const array = [];
        factura.addEventListener('change', function(){
            array.push(@json($facturas));
            for(let i = 0; i < array.length; i++){
                if(array[0][i].id == factura.value){
                    montoPagado.value = (array[0][i].totalFactura - array[0][i].totalPagado).toFixed(2);
                    pagoRealizado.setAttribute('max', montoPagado.value);
                    console.log(montoPagado.value);
                }else{
                    montoPagado.value = 0;
                    pagoRealizado.setAttribute('max', array[0][i].totalFactura);
                    console.log(montoPagado.value);
                }
            }
        })

    </script>
@endsection