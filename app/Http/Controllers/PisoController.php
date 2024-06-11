<?php
namespace App\Http\Controllers;

use App\Models\Piso;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Proovedor;
class PisoController extends Controller
{
    public function index()
    {
        $pisos = Piso::all();
        return view('pisos.index', compact('pisos'));
    }

    public function create()
    {
        return view('pisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Piso::create($request->all());

        return redirect()->back()->with('success', 'Piso Creado exitosamente.');
    }

    public function show(Piso $piso)
    {
        return view('pisos.show', compact('piso'));
    }

    public function edit(Piso $piso)
    {
        return view('pisos.edit', compact('piso'));
    }

    public function update(Request $request, Piso $piso)
    {
        $pisos = Piso::all();
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $piso->update($request->all());
        $categorias = Categoria::all();
        $proveedores = Proovedor::all();
        return view('configuracion.index', compact('pisos','proveedores','categorias'))->with('success', 'Piso actualizado con éxito.');
     
    }

    public function destroy(Piso $piso)
    {
        $piso->delete();

        return redirect()->route('pisos.index')->with('success', 'Piso eliminado con éxito.');
    }
}