<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'imagen',
        'nombre',
        'descripcion',
        'categoria_id',
        'proovedor_id',
        'precio_compra', 
        'precio_venta',
        'cantidad_stock',
        'unidad',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
