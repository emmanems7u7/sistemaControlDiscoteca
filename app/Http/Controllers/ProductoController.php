<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proovedor;
use Illuminate\Http\Request;
use App\Traits\Base64ToFile;

class ProductoController extends Controller
{
    use Base64ToFile;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productos = Producto::query();
        $categorias = Categoria::all();
        $proveedores = Proovedor::all();

        if ($request->filled('categoria_id')) {
            $productos->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('buscar')) {
            $productos->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('stock_bajo')) {
            $productos->where('cantidad_stock', '<', 10);
        }

        $productos = $productos->paginate(10);

        return view('productos.index',compact('productos','categorias','proveedores'));
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
        $producto = Producto::create([
            'imagen'=> (!empty($request['imagen']))?$this->convert($request['imagen']):null,
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'categoria_id'=>$request->categoria,
            'proovedor_id'=>$request->proveedor,
            'precio_compra'=>$request->precioC, 
            'precio_venta'=>$request->precioV,
            'cantidad_stock'=>$request->stock,
            'unidad'=>$request->unidad,
        ]);
        return redirect()->back()->with('success', 'Producto guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }
    public function showJson($id)
    {
         // Buscar el producto por su ID
         $producto = Producto::find($id);

         // Verificar si el producto existe
         if (!$producto) {
             return response()->json(['message' => 'producto no encontrado'], 404);
         }
 
         // Devolver los datos del producto en formato JSON
         return response()->json($producto);
    }
    public function extraeProductos($id)
    {
         // Buscar el producto por su ID
        $data = Producto::all();
      
         // Verificar si el producto existe
         if (!$data) {
             return response()->json(['message' => 'producto no encontrado'], 404);
         }
 
         // Devolver los datos del producto en formato JSON
         return response()->json($data);
    }
    public function extraeProductosCategoria($id)
    {
         // Buscar el producto por su ID
        $data = Producto::where('categoria_id',$id)->get();
      
         // Verificar si el producto existe
         if (!$data) {
             return response()->json(['message' => 'producto no encontrado'], 404);
         }
 
         // Devolver los datos del producto en formato JSON
         return response()->json($data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }
    public function updateJson(Request $request, $id)
    {
          
         $producto = Producto::find($id);


         if (!$producto) {
             return response()->json(['message' => 'producto no encontrado'], 404);
         }
        
                    $producto->nombre = $request->nombre;
                    if ($request->has('imagen') && !empty($request->imagen)) {
                        $producto->imagen = $this->convert($request->imagen);
                    }
                    $producto->descripcion= $request->descripcion;
                    $producto->categoria_id= $request->categoria;
                    $producto->proovedor_id= $request->proveedor;
                    $producto->precio_compra= $request->precioC;
                    $producto->precio_venta= $request->precioV;
                    $producto->cantidad_stock= $request->stock;
                    $producto->unidad= $request->unidad;
                    $producto->save();
 
        
         return response()->json(['message' => 'producto actualizado exitosamente'], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
    
    
}
