<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function ventas(request $request)
    {
        
        // Obtener los datos enviados a través de la solicitud HTTP
        $venta = $request->input('venta');
        $fecha = $request->input('fecha');
//dd($request->input('venta'));
        // Decodificar el JSON para obtener el arreglo de datos de venta
        $datosVenta = json_decode($venta[0], true);

        // Pasar los datos a la vista del PDF
        $ventas = [
            'id' => $datosVenta['id'],
            'nombre' => $datosVenta['nombre'],
            'montoT' => $datosVenta['montoT'],
            'ventas' => $datosVenta['ventas'],
        ];
     
        //dd($ventas);
        // Renderizar la vista con los datos
        $pdf = PDF::LoadView('ventas.reporteVentas', compact('ventas','fecha'))->setPaper('a4', 'portrait');

        // Descargar el PDF
        return $pdf->stream('reporte_ventas.pdf');
      
    }
}
