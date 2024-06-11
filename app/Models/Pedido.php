<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'user_id',
        'producto_id',
        'mesa_id',
        'fecha_pedido',
        'cantidad',
        'Tpago',
        'monto',
        'estado',
    ];
}
