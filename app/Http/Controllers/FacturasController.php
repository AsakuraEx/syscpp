<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }

    public function viewDashboard()
    {
        $graficoLineal = DB::select('SELECT fechaFactura, COUNT(fechaFactura) as cantidad FROM facturas GROUP BY fechaFactura ORDER BY fechaFactura ASC');
        $cantidadFacturas = count($graficoLineal); //Cantidad de fechas con facturas
        $facturasTotales = count(Factura::all());   //Cantidad total de facturas
        $facturasPagadas = count(DB::select("SELECT * FROM facturas WHERE estadoFactura = 'Pagado'")); //Total de facturas pagadas
        $facturasSinPagar = $facturasTotales - $facturasPagadas; //Facturas sin pagar es igual a la diferencia de las facturas pagadas
        $mejorProveedor = DB::select("SELECT p.nombreProveedor AS proveedor, COUNT(idProveedor) AS total FROM facturas f, proveedores p WHERE f.idProveedor = p.id GROUP BY idProveedor ORDER BY total DESC LIMIT 1");
        //mejor proveedor y facturas por proveedor.
        $graficoBarras = DB::select("SELECT p.nombreProveedor AS proveedor, COUNT(idProveedor) AS total 
                                        FROM facturas f, proveedores p WHERE f.idProveedor = p.id 
                                        GROUP BY idProveedor"
                                    );
        $cantidadFacturasP = count($graficoBarras);

        //Informacion del ultimo pago
        $ultimoPago = DB::select("SELECT p.pagoRealizado,  p.updated_at AS fecha, pr.nombreProveedor 
                                    FROM pagos p, facturas f, proveedores pr 
                                    WHERE p.idFactura = f.id AND f.idProveedor = pr.id
                                    ORDER BY p.updated_at DESC 
                                    LIMIT 1"
                                );

        //Array para mostrar el grafico de lineas
        $dataGL = [
            'fecha' => [],
            'cantidad' => []
        ];

        for ($i = 0; $i < $cantidadFacturas; $i++){
            $dataGL['fecha'][] = $graficoLineal[$i]->fechaFactura;
            $dataGL['cantidad'][] = $graficoLineal[$i]->cantidad;
        };

        //Array para mostrar el grafico de barras
        $dataBar = [
            'proveedor' => [],
            'cantidad' => []
        ];

        for ($i = 0; $i < $cantidadFacturasP; $i++){
            $dataBar['proveedor'][] = $graficoBarras[$i]->proveedor;
            $dataBar['cantidad'][] = $graficoBarras[$i]->total;
        };

        //dd($ultimoPago);
        //$facturas = DB::select('select * from facturas where id = ?', [4]);
        
        return view('dashboard', compact('facturasTotales','facturasPagadas',
        'facturasSinPagar', 'mejorProveedor' ,'dataGL', 'dataBar', 'ultimoPago'));
        
    }
}
