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

        //Array para mostrar el grafico de lineas
        $dataGL = [
            'fecha' => [],
            'cantidad' => []
        ];

        for ($i = 0; $i < $cantidadFacturas; $i++){
            $dataGL['fecha'][] = $graficoLineal[$i]->fechaFactura;
            $dataGL['cantidad'][] = $graficoLineal[$i]->cantidad;
        };
        //dd($dataGL);
        //$facturas = DB::select('select * from facturas where id = ?', [4]);
        
        return view('home', compact('facturasTotales','dataGL'));
        
    }
}
