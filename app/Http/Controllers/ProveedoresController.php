<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = DB::table('proveedores as p')
        ->leftJoin('facturas as f', 'p.id','=', 'f.idProveedor')
        ->select('p.id', 'p.nombreProveedor', 'p.telefonoProveedor', 'p.correoProveedor', DB::raw('COUNT(f.idProveedor) as totalFacturas'))
        ->orderBy('p.nombreProveedor','ASC')
        ->groupBy('p.id','p.nombreProveedor', 'p.telefonoProveedor', 'p.correoProveedor')
        ->paginate(10);
        
        //dd($proveedores);
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        $data = $request->validated();
        Proveedor::create($data);
        return to_route('proveedores.index')->with('success', 'Proveedor creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        //d($proveedor);
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProveedorRequest $request, $id)
    {
        $data = $request->validated();
        Proveedor::where('id', $id)->update($data);
        return to_route('proveedores.index')->with('success', 'Proveedor actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id); 
        $proveedor->delete();
        return to_route('proveedores.index')->with('success', 'Elemento eliminado satisfactoriamente');
    }

    public function buscarProveedor(Request $request){

        if($request->accion == 'buscar'){
            $proveedores = DB::table('proveedores as p')
            ->leftJoin('facturas as f', 'p.id','=', 'f.idProveedor')
            ->select('p.id', 'p.nombreProveedor', 'p.telefonoProveedor', 'p.correoProveedor', DB::raw('COUNT(f.idProveedor) as totalFacturas'))
            ->orderBy('p.nombreProveedor','ASC')
            ->groupBy('p.id','p.nombreProveedor', 'p.telefonoProveedor', 'p.correoProveedor')
            ->where('p.nombreProveedor','like', '%'.$request->proveedor.'%')->paginate(10);
        
            if($request->proveedor == null){
                $proveedores = DB::table('proveedores')->orderBy('nombreProveedor','ASC')->paginate(10);
            }
            return view('proveedores.index', compact('proveedores'));
        }else{
            $pdfcontroller = new PDFController;
            return $pdfcontroller->proveedoresPDF($request->proveedor);
        }
        

    }

    public function rankingProveedores(){
        
        $data = DB::table('facturas as f')
                    ->join('proveedores as p','f.idProveedor','=','p.id')
                    ->select('p.nombreProveedor', DB::raw('COUNT(f.id) as totalFacturas'))
                    ->groupBy('f.idProveedor')
                    ->orderBy('totalFacturas', 'desc')
                    ->limit(10)
                    ->get();

        $totalFacturas = DB::table('facturas')->count('id');

        $contador = 1;

        return view('proveedores.ranking', compact('data', 'contador', 'totalFacturas'));
    }
}
