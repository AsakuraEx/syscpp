<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
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
        return redirect('/proveedores')->with('success', 'Proveedor creado satisfactoriamente');
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
    public function update(Request $request, Proveedor $proveedor)
    {
        return redirect('/proveedores')->with('success', 'Proveedor creado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
