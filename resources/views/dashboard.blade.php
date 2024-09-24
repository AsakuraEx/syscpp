<!-- *********************************************************************  -->

@extends('templates.base')

@section('title', 'Dashboard')

@section('scripts-2')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('facturasProveedor');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: @json($dataBar['proveedor']),
            datasets: [{
              label: 'Facturas por Proveedor',
              data: @json($dataBar['cantidad']),
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

        const labels = @json($dataGL['fecha']);

        const data = {
        labels: labels,
        datasets: [{
                label: 'Facturas Emitidas',
                data: @json($dataGL['cantidad']),
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

    <div class="fila">
        <div class="card">
            <h3>Total de Facturas Emitidas</h3>
            <span>{{ $facturasTotales }}</span>
        </div>
        <div class="card">
            <h3>Total de Facturas Pagadas</h3>
            <span>{{ $facturasPagadas }}</span>
        </div>
        <div class="card">
            <h3>Total de Facturas Sin Pagar</h3>
            <span>{{ $facturasSinPagar }}</span>
        </div>
    </div>

    <div class="fila">
        <div class="card col-2">
            <h3>Mejor Proveedor</h3>
            <span>{{ $mejorProveedor[0]->proveedor }}</span>
        </div>

        <div class="card col-2">
            <h3>Información de último pago</h3>
            <div class="card-larga">
                <div>
                    <p>
                        <b>Fecha del ultimo pago</b>
                    </p>
                    <p>{{ $ultimoPago[0]->fecha }}</p>
                </div>
                <div>
                    <p>
                        <b>Monto pagado</b>
                    </p>
                    <p>${{ $ultimoPago[0]->pagoRealizado }}</p>
                </div>
                <div>
                    <p>
                        <b>Proveedor</b>
                    </p>
                    <p>{{ $ultimoPago[0]->nombreProveedor }}</p>
                </div>
            </div>
        </div>
    </div>



    <div class="fila">
        <div class="grafico">
            <span>Facturas por Proveedor</span>
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

        :root {
            --verde-oscuro: #2f3e46;
            --verde-semioscuro: #354f52;
            --verde-medio: #52796f;
            --verde-claro: #84a98c;
            --gris-verde: #cad2c5;
            --gris-verde-2: rgb(228, 236, 223);
            --blanco: #ffffff;
        }

        h1 {
            color:#84a98c;
            border-bottom: 4px solid;
            border-color: #84a98c;
            margin-bottom: 2rem;
            padding-bottom: 8px;
            font-weight: 900;
        }

        .fila {
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
            padding-bottom: 24px;   
        }
        .grafico {
            padding: 1rem;
            font-size: 16px;
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            box-shadow: 2px 10px 11px -11px rgba(0,0,0,0.75);
        }

        .card {
            padding: 2rem;
            font-size: 16px;
            font-weight: 700;
            border: 1px solid #d9d9d9;
            border-radius: 5px;
            box-shadow: 2px 10px 11px -11px rgba(0,0,0,0.75);
            display: flex;
            flex-direction: column;
            gap: 24px;       
            color: #52796f; 
        }

        .card h3 {
            margin: 0;
            padding: 0;
            font-weight: 700;
            border-bottom: 2px solid #52796f;
            padding-bottom: 20px;
        }

        .card span {
            font-size: 32px;
            font-weight: 900;
        }

        .card p {
            margin: 0;
            padding: 0;
            font-size: 24px;
            font-weight: 500;
        }

        .card-larga{
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        @media screen and (min-width: 720px) {
            .fila {
                display: flex;
                flex-direction: row;
            }

            .grafico {
                width: 50%;
            }

            .card {
                width: 33%;
            }

            .card-larga{
                display: flex;
                flex-direction: row;
                gap: 24px;
            }

                
            .col-2 {
                width: 50%;
            }

        }



    </style>

@endsection
