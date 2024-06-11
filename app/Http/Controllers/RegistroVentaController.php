<?php

namespace App\Http\Controllers;

use App\Models\RegistroVenta;
use Illuminate\Http\Request;
use App\Models\VentaDia; 
use App\Models\User; 
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
class RegistroVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
   
    $cajeroRole = Role::where('name', 'cajero')->first();

   
    $user = Auth::user();

   
    $pisoId = $user->pisos->pluck('id')->first();

   
    $cajeros = User::whereHas('roles', function ($query) use ($cajeroRole) {
        $query->where('role_id', $cajeroRole->id);
    })->whereHas('pisos', function ($query) use ($pisoId) {
        $query->where('piso_id', $pisoId);
    })->get();

   //dd($cajeros);
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

  
    if (!$fechaInicio && !$fechaFin) {
        
        $guardar = true;
        $fechaInicio = Carbon::now()->toDateString();
        $fecha = Carbon::now()->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
        $fechaN=Carbon::now()->toDateString();
        $fechaFin = Carbon::now()->toDateString();
      
    }
 
    $ventas = [];
    $montoF=0;
    foreach ($cajeros as $cajero) {
        $query = RegistroVenta::select(
            'users.name as cajero',
            'registro_ventas.fecha_venta',
            'registro_ventas.hora_venta',
            'pedidos.cantidad',
            'pedidos.id as codP',
            'pedidos.Tpago',
            'pedidos.monto',
            'productos.nombre',
            'productos.descripcion',
            'users2.name as mesero'
        )
        ->join('pedidos', 'registro_ventas.pedido_id', '=', 'pedidos.id')
        ->join('productos', 'pedidos.producto_id', '=', 'productos.id')
        ->join('users', 'registro_ventas.user_id', '=', 'users.id')
        ->join('users as users2', 'pedidos.user_id', '=', 'users2.id')
        ->where('registro_ventas.user_id', $cajero->id)
        ->whereBetween('registro_ventas.fecha_venta', [$fechaInicio, $fechaFin]);

        $dat = $query->get();

        $montoT = 0;

        foreach ($dat as $venta) {
            $montoT += $venta->monto;
        }

        $ventas[] = [
            'id' => $cajero->id,
            'nombre' => $cajero->name." ".$cajero->apepat." ".$cajero->apemat,
            'montoT' => $montoT,
            'ventas' => $dat,
        ];
        $montoF += $montoT;
    }
//dd($ventas);
    
if($fechaInicio === $fechaFin)
{
    
    $fecha = Carbon::createFromFormat('Y-m-d', $fechaInicio);
    $fechaN=Carbon::now()->toDateString();
    $fecha = $fecha->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
    $guardar = true;
}
else
{
    $fechaInicio = Carbon::now()->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
    $fechaFin = Carbon::now()->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y');
    $fecha = 'De '.$fechaInicio.' A '.$fechaFin ;
    $fechaN=Carbon::now()->toDateString();
    $guardar = false;
}
    

    return view('ventas.index', compact('ventas','fecha','montoF','fechaN','guardar'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function ventas($id,$UserId,$venta)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function ventasR()
    {
        $ventaDia = VentaDia::with('piso')->get();
     
        return view('ventas.ventasDia',compact('ventaDia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function GuardarVenta(request $request)
    {
        $user = Auth::user();
        $pisos = $user->pisos;
        $pisos = $user->pisos->pluck('id')->first();
        $ventadia = VentaDia::where('fecha',$request->fecha)->first();
        if(empty($ventadia))
        {
            VentaDia::create([
                'fecha'=>$request->fecha,
             'piso_id'=>$pisos,
             'monto'=>$request->montoT,
            ]);
            $mensaje ='Registro de la fecha '.$request->fechal.' guardado exitosamente.';
            return redirect()->back()->with('success', $mensaje );
        }
        else
        {
            $mensaje='Ya se guardo el registro de la fecha '.$request->fechal.'!';
            return redirect()->back()->with('error',   $mensaje);
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistroVenta $registroVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroVenta $registroVenta)
    {
        //
    }
}
