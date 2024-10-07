<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacturaRequest;
use App\Models\Factura;
use App\Models\Pago;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = DB::table('facturas as f')
                ->join('proveedores as p', 'f.idProveedor', '=', 'p.id')
                ->select('f.id','f.fechaFactura', 'f.facturador', 'f.totalFactura','f.estadoFactura', 'p.nombreProveedor')
                ->orderBy('fechaFactura', 'desc')
                ->Paginate(10);

        $proveedores = DB::table('proveedores')->pluck('id', 'nombreProveedor');

        return view('facturas.index', compact('facturas', 'proveedores'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = DB::table('proveedores')->pluck('id', 'nombreProveedor');

        return view('facturas.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        $data = $request->validated();
        Factura::create($data);
        return to_route('facturas.index')->with('success', 'Factura creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $factura = DB::table('facturas as f')
                    ->join('proveedores as p', 'p.id', '=', 'f.idProveedor')
                    ->select('f.fechaFactura', 'f.facturador', 'f.totalFactura', 'p.nombreProveedor', 'f.estadoFactura')
                    ->where('f.id', $id)
                    ->first();
        $pagosFactura = Pago::where('idFactura', $id)->get();
        $i = 1;
        return view('facturas.show', compact('factura', 'pagosFactura', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $factura = Factura::find($id);
        $proveedores = DB::table('proveedores')->pluck('id', 'nombreProveedor');
        $fechaActual = new DateTime();
        $fechaActual->modify("-1 day");
        return view('facturas.edit', compact('factura', 'proveedores', 'fechaActual'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFacturaRequest $request, Factura $factura)
    {
        $data = $request->validated();
        $factura->update($data);
        return to_route('facturas.index')->with('success', 'Factura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $factura = Factura::find($id); 
        $factura->delete();
        return to_route('facturas.index')->with('success', 'Elemento eliminado satisfactoriamente');

    }

    public function viewDashboard()
    {
        //mejor proveedor y facturas por proveedor.
        $graficoBarras = DB::select("SELECT p.nombreProveedor AS proveedor, COUNT(idProveedor) AS total 
                                        FROM facturas f, proveedores p WHERE f.idProveedor = p.id 
                                        GROUP BY idProveedor ORDER BY total DESC LIMIT 5"
                                    );

        $mejorProveedor = DB::select("SELECT p.nombreProveedor AS proveedor, COUNT(idProveedor) AS total 
                                        FROM facturas f, proveedores p WHERE f.idProveedor = p.id 
                                        GROUP BY idProveedor ORDER BY total DESC 
                                        LIMIT 1"
                                    );

        //Informacion del ultimo pago
        $ultimoPago = DB::select("SELECT p.pagoRealizado,  p.updated_at AS fecha, pr.nombreProveedor 
                                    FROM pagos p, facturas f, proveedores pr 
                                    WHERE p.idFactura = f.id AND f.idProveedor = pr.id
                                    ORDER BY p.updated_at DESC 
                                    LIMIT 1"
                                );

        $graficoLineal = DB::select('SELECT fechaFactura, COUNT(fechaFactura) as cantidad FROM facturas GROUP BY fechaFactura ORDER BY fechaFactura ASC LIMIT 30');
        $cantidadFacturas = count($graficoLineal); //Cantidad de fechas con facturas
        $facturasTotales = count(Factura::all());   //Cantidad total de facturas
        $facturasPagadas = count(DB::select("SELECT * FROM facturas WHERE estadoFactura = 'Pagado'")); //Total de facturas pagadas
        $facturasSinPagar = $facturasTotales - $facturasPagadas; //Facturas sin pagar es igual a la diferencia de las facturas pagadas

        $cantidadFacturasP = count($graficoBarras);



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

    public function buscarFactura(Request $request){
        
        $proveedor = $request->idProveedor;
        $estado = $request->estadoFactura;
        $fecha = $request->fecha;

        $facturas = DB::table('facturas as f')
            ->join('proveedores as p', 'f.idProveedor', '=', 'p.id')
            ->select('f.id','f.fechaFactura', 'f.facturador', 'f.totalFactura','f.estadoFactura','f.idProveedor', 'p.nombreProveedor')
            ->orderBy('fechaFactura', 'desc');
        
        if($proveedor != null){
            $facturas->where('f.idProveedor', $proveedor);
        }
        if($estado != null){
            $facturas->where('f.estadoFactura', $estado);
        }
        if($fecha != null){
            $facturas->where('f.fechaFactura', $fecha);
        }
        
        $facturas = $facturas->Paginate(10);

        $proveedores = DB::table('proveedores')->pluck('id', 'nombreProveedor');

        return view('facturas.index', compact('facturas', 'proveedores'));

    }


}
