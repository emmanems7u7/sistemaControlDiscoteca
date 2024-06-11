<?php

namespace App\Http\Controllers;

use App\Models\Proovedor;
use App\Models\Piso;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProovedorController extends Controller
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
       
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'persona_contacto' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:proovedors,correo',
            'telefono' => 'required|string|max:15',
        ]);

        Proovedor::create($datosValidados);

        return redirect()->back()->with('success', 'Proveedor guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proovedor $proovedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proovedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'persona_contacto' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
        ]);

        $proveedor = Proovedor::findOrFail($id);
        $proveedor->update($request->all());

        $pisos = Piso::all();
        $categorias = Categoria::all();
        $proveedores = Proovedor::all();
        return view('configuracion.index', compact('pisos','proveedores','categorias'))->with('success', 'Proveedor actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proovedor $proovedor)
    {
        //
    }
    public function extraeProovedorJson($id)
    {
        
        $pro = Proovedor::where('id',$id)->first();
  
        if (!$pro) {
            return response()->json(['message' => 'proveedor no encontrado'], 404);
        }

        return response()->json($pro);
    }
    
}
