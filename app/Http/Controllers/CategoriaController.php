<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Piso;
use App\Models\Proovedor;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
            'descripcion' => 'nullable|string',
        ]);

        Categoria::create($datosValidados);

        return redirect()->back()->with('success', 'Categoria guardada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        $pisos = Piso::all();
        $categorias = Categoria::all();
        $proveedores = Proovedor::all();
        return view('configuracion.index',compact('pisos','proveedores','categorias'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
    public function extraeCategoriaJson($id)
    {
        $cat = Categoria::where('id',$id)->first();

        if (!$cat) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($cat);
    }
}
