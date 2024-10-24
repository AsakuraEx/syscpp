<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function rankingPDF() 
    {

        // Datos que pasarás a la vista
        $proveedores = DB::table('facturas as f')
        ->join('proveedores as p','f.idProveedor','=','p.id')
        ->select('p.nombreProveedor', DB::raw('COUNT(f.id) as totalFacturas'))
        ->groupBy('f.idProveedor')
        ->orderBy('totalFacturas', 'desc')
        ->limit(10)
        ->get();

        $totalFacturas = DB::table('facturas')->count('id');

        $contador = 1;

        $data = [
            'data' => $proveedores, 
            'totalFacturas' => $totalFacturas, 
            'contador' =>$contador
        ];

        //dd($data);

        // Cargar la vista y pasar los datos
        $pdf = Pdf::loadView('reportes.rankingPDF', $data);

        // Retornar el PDF como descarga
        return $pdf->stream('archivo.pdf');

    }

    public function facturasPDF($proveedorp, $estadop, $fechap)
    {
        $proveedor = $proveedorp;
        $estado = $estadop;
        $fecha = $fechap;

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

        $facturas = $facturas->get();
        
        $data = [
            'facturas' => $facturas
        ];

        $pdf = Pdf::loadView('reportes.facturasPDF', $data);

        // Retornar el PDF como descarga
        return $pdf->stream('archivo.pdf');
    }

    public function proveedoresPDF($proveedorp)
    {
        $proveedores = DB::table('proveedores')->where('nombreProveedor','like', '%'.$proveedorp.'%')->orderBy('nombreProveedor','ASC')->get();
        $data = [
            'proveedores' => $proveedores
        ];

        $pdf = Pdf::loadView('reportes.proveedoresPDF', $data);

        // Retornar el PDF como descarga
        return $pdf->stream('archivo.pdf');
    }

    public function pagosPDF($proveedorp, $fechap, $fechapagop)
    {
        $pagos = DB::table('facturas as f')
            ->join('pagos as p', 'f.id', '=', 'p.idFactura')
            ->join('proveedores as pr', 'pr.id', '=', 'f.idProveedor')
            ->select('p.id', 'f.estadoFactura', 'f.fechaFactura', 'f.totalFactura', 'p.pagoRealizado', 'p.idFactura', 'pr.id', 'pr.nombreProveedor', 'p.updated_at')
            ->orderBy('p.updated_at', 'desc');
    
        // Agregar condiciones dinámicas (filtros activos)
        if ($proveedorp != null) {
            $pagos->where('pr.id', '=', $proveedorp);
        }
        
        if ($fechap != null) {
            $pagos->where('f.fechaFactura', '=', $fechap);
        }
        
        if ($fechapagop != null) {
            $pagos->where('p.updated_at', 'like', $fechapagop . '%');
        }
        
        // Ejecutar la consulta paginada
        $pagos = $pagos->get();


        $pagosTotales = DB::table('pagos')->select('idFactura', DB::raw('SUM(pagoRealizado) as totalPagado'))->groupBy('idFactura')->get();

        $proveedores = DB::table('proveedores')->pluck('id','nombreProveedor');

        $data = [
            'pagos' => $pagos,
            'proveedores' => $proveedores,
            'pagosTotales' => $pagosTotales
        ];

        $pdf = Pdf::loadView('reportes.pagosPDF', $data);

        // Retornar el PDF como descarga
        return $pdf->stream('archivo.pdf');
    }
}
