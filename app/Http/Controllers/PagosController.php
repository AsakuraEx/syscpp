<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = DB::table('facturas as f')
                    ->join('pagos as p','f.id','=', 'p.idFactura')
                    ->join('proveedores as pr', 'pr.id', '=', 'f.idProveedor')
                    ->select('p.id', 'f.estadoFactura', 'f.fechaFactura', 'f.totalFactura', 'p.pagoRealizado', 'p.idFactura', 'pr.nombreProveedor', 'p.updated_at')
                    ->orderBy('p.updated_at', 'desc')
                    ->Paginate(10);

        $pagosTotales = DB::table('pagos')->select('idFactura', DB::raw('SUM(pagoRealizado) as totalPagado'))->groupBy('idFactura')->get();
        return view('pagos.index', compact('pagos', 'pagosTotales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facturas = DB::table('facturas as f')
            ->join('pagos as p', 'f.id', '=', 'p.idFactura')
            ->select('f.fechaFactura', 'f.id', 'f.totalFactura', 'f.estadoFactura',DB::raw('SUM(p.pagoRealizado) as totalPagado'))
            ->where('f.estadoFactura','!=', 'Pagado')
            ->groupBy('f.fechaFactura', 'f.id', 'f.totalFactura', 'f.estadoFactura')
            ->get();

        $facturasSinPagar = DB::table('facturas')->where('estadoFactura', '!=', 'Pagado')->get();
        return view('pagos.create', compact('facturas', 'facturasSinPagar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Guardando el pago
        $data = $request->all();
        Pago::create($data);

        //Obteniendo la factura
        $factura = Factura::where('id',$request->idFactura)->first();

        //calculando el saldo de pagos realizados
        $saldo = DB::table('pagos')
                ->where('idFactura', $request->idFactura)
                ->select(DB::raw('SUM(pagoRealizado) as total'))
                ->first();

        //calcula el saldo pendiente        
        $resta = $factura->totalFactura - $saldo->total;

        // Determina el estado de la factura
        if($resta == 0){
            //Si el saldo pendiente es cero
            $factura->update(['estadoFactura' => 'Pagado']);
        } elseif ($resta > 0){
            //Si existe saldo pendiente, la factura esta parcialmente pagada
            $factura->update(['estadoFactura' => 'Pagado Parcialmente']);
        }
   
        return to_route('pagos.index')->with('success', 'Pago registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = Pago::where('id',$id)->first(); 
        $pago->delete();

        $factura = Factura::where('id', $pago->idFactura)->first();    
        $totalPagos = Pago::where('idFactura', $factura->id)
                        ->sum('pagoRealizado'); 

        if ($totalPagos == 0) {
            $factura->update(['estadoFactura' => 'Sin Pagar']);
        }

        return to_route('pagos.index')->with('success', 'Elemento eliminado satisfactoriamente');
    }
}
