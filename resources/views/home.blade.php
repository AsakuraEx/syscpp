<!-- *********************************************************************  -->

@extends('templates.base')

@section('title', 'Inicio')

@section('scripts-2')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('facturasProveedor');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Proveedor 1', 'Proveedor 2', 'Proveedor 3', 'Proveedor 4', 'Proveedor 5', 'Proveedor 6'],
            datasets: [{
              label: 'Facturas por Proveedor',
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

    </script>

    <script>
        
        const graficoLineas = document.getElementById('facturasEmitidas');

        const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        console.log(labels);
        const data = {
        labels: labels,
        datasets: [{
                label: 'Facturas Emitidas',
                data: [65, 59, 80, 81, 56, 55, 40, 100, 25, 65, 30, 60, 65],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,
        };

        new Chart(graficoLineas, config);
    </script>

@endsection

@section('contenido')

    <h1>Dashboard</h1>

    <h3>Cantidad de Facturas Emitidas</h3>
    <h3>Cantidad de Facturas Pagadas</h3>
    <h3>Cantidad de Facturas Sin Pagar</h3>

    <h3>Mejor proveedor</h3>
    <h3>Fecha de Último Pago</h3>

    <div class="fila">
        <div class="grafico">
            <span>Pago por Proveedor</span>
            <canvas id="facturasProveedor"></canvas>
        </div>
        <div class="grafico">
            <span>Facturas Emitidas</span>
            <canvas id="facturasEmitidas"></canvas>
        </div>
    </div>



@endsection



@section('styles')
    
    <style>
        .fila {
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
        }
        .grafico {
            padding: 1rem;
            width: 500px;
            font-size: 16px;
            font-weight: 700;
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            box-shadow: 2px 10px 11px -11px rgba(0,0,0,0.75);
        }

        @media screen and (min-width: 720px) {
            .fila {
                display: flex;
                flex-direction: row;
            }
        }

    </style>

@endsection
