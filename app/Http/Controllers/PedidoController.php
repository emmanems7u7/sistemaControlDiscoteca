<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

use App\Models\RegistroVenta;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\USer;
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $user = Auth::user();
        $fechaN=Carbon::now()->toDateString();
        $fecha = Carbon::now()->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
        $mesas = Mesa::all();
        $categorias = Categoria::all();
        
        $pedidos = Pedido::where('user_id', $user->id)
        ->whereDate('fecha_pedido', $fechaN)
        ->orderByDesc('fecha_pedido')
        ->select('pedidos.id','pedidos.fecha_pedido','pedidos.cantidad','pedidos.estado','productos.nombre','pedidos.monto','pedidos.Tpago','productos.unidad','mesas.nombre as mesa')
        ->join('productos','pedidos.producto_id','productos.id')
        ->join('mesas','pedidos.mesa_id','mesas.id')
        
        ->get();



        $pedidosall = Pedido::where('user_id', $user->id)
        ->orderByDesc('fecha_pedido')
        ->select('pedidos.id','pedidos.fecha_pedido','pedidos.cantidad','pedidos.estado','productos.nombre','pedidos.monto','pedidos.Tpago','productos.unidad','mesas.nombre as mesa')
        ->join('productos','pedidos.producto_id','productos.id')
        ->join('mesas','pedidos.mesa_id','mesas.id')
        
        ->get();

        return view('pedidos.index',compact('categorias','mesas','pedidos' ,'fecha','pedidosall'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verPedidos(Request $request)
    {
        $user = Auth::user();
        $pisos = $user->pisos;
        $pisos = $pisos->pluck('id');
    
        $usuarios = User::whereHas('pisos', function ($query) use ($pisos) {
            $query->whereIn('pisos.id', $pisos);
        })->get();
    
        $fecha = $request->input('fecha');
    
        // Array para almacenar los pedidos por usuario
        $pedidosPorUsuario = [];
    
        // Iterar sobre cada usuario
        foreach ($usuarios as $usuario) {
            // Obtener los pedidos del usuario actual
            $query = Pedido::where('user_id', $usuario->id)
                ->select('pedidos.id', 'pedidos.fecha_pedido', 'pedidos.cantidad', 'pedidos.estado', 'productos.nombre', 'pedidos.monto', 'pedidos.Tpago', 'productos.unidad', 'mesas.nombre as mesa')
                ->orderByDesc('pedidos.fecha_pedido')
                ->join('productos', 'pedidos.producto_id', 'productos.id')
                ->join('mesas', 'pedidos.mesa_id', 'mesas.id');
    
            // Filtrar por fecha si se proporciona
            if ($fecha) {
                $query->whereDate('pedidos.fecha_pedido', $fecha);
            }
    
            $pedidos = $query->get();
    
            // Agregar los pedidos al array utilizando el nombre de usuario como clave
            $pedidosPorUsuario[$usuario->name] = $pedidos;
        }
        Carbon::setLocale('es');
        $carbonFecha = Carbon::parse($fecha);
        $fecha = $carbonFecha->isoFormat('dddd D \d\e MMMM \d\e\l Y');
        return view('pedidos.pedidosAll', compact('pedidosPorUsuario', 'fecha'));
    }
    
    public function validar($id)
    {
        $user = Auth::user();
        $pedido = Pedido::find($id);
        $producto = Producto::find($pedido->producto_id);

        $fechaActual = Carbon::now()->toDateString(); 
        $horaActual = Carbon::now()->toTimeString(); 

        if ($pedido && $pedido->estado === 'pendiente') {
            if( $producto->cantidad_stock >= $pedido->cantidad)
                {
                    $pedido->estado = "completado";
                    $pedido->save();
        
                    $producto->cantidad_stock -= $pedido->cantidad;
                    $producto->save();    
                    $fechaActual = Carbon::now()->toDateString(); 
                    $horaActual = Carbon::now()->toTimeString(); 
                    
                    $venta = RegistroVenta::create([
                        'user_id'=> $user->id,
                        'pedido_id' => $id,
                        'fecha_venta' => $fechaActual,
                        'hora_venta' => $horaActual,
                    ]);
                    return redirect()->back()->with('success', 'El pedido se ha validado correctamente.') ;
                }
                else{
                    return redirect()->back()->with('error', 'El Producto esta agotado!');
                }
            
        
        } elseif ($pedido && $pedido->estado == 'completado') {
           
            return redirect()->back()->with('warning', 'El pedido ya se encuentra validado.');
        } else {
           
            return redirect()->back()->with('error', 'El pedido esta cancelado');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fecha = Carbon::now();
        $user = Auth::user();
        $producto = Producto::find($request->producto_id);
        $monto = $producto->precio_venta * $request->cantidad;
        $pedido = Pedido::create([
            'user_id' =>$user->id,
            'producto_id'=> $request->producto_id,
            'mesa_id' =>$request->mesa,
            'fecha_pedido'=> $fecha,
            'cantidad'=> $request->cantidad,
            'Tpago'=>$request->pago,
            'monto'=>$monto,
            'estado' =>'pendiente',
        ]);
        return redirect()->back()->with('success', 'Se realizo pedido exitosamente.');
        
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function cancelar($id)
    {
        $pedido = Pedido::find($id);
        $pedido->estado = 'cancelado';
        $pedido->save();
        return redirect()->back()->with('warning', 'Se cancelo pedido.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
