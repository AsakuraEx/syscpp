<!DOCTYPE html>
<html>
<head>
    <title>PDF generado</title>
</head>
<body>

    <h1>Organización NONG</h1>
    <h3><center>@yield('titulo')</center></h3>
    Usuario que genera reporte: {{ Auth::user()->name }} <br>
    Fecha y hora del reporte: {{ date('Y-m-d h:i:s A') }}
    <br><br>
    @yield('tabla')

    Documento generado a través del Sistema Informático de Control de Pagos a Proveedores de una Organización No Gubernamental (SYSCPP).

    <style>
        .tabla {
            overflow-x: auto;
        }

        h1 {
            color:#686868;
            border-bottom: 4px solid;
            border-color: #686868;
            margin-bottom: 2rem;
            padding-bottom: 8px;
            font-weight: 900;
            text-align: center;
        }

        table{
            width: 100%;
            margin-bottom: 24px;
        }

        .table-head{
            text-align: center;
            text-transform: uppercase;
            color: #ffffff;
            background-color: #686868;
        }

        .table-head td {
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.2rem;
            padding-bottom: 0.2rem;
        }

        .table-row {
            color: var(--verde-semioscuro);
            background-color: #ffffff;
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
</body>
</html>