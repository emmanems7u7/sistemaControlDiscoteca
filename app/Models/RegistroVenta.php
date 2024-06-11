<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pedido_id' ,
        'fecha_venta' ,
        'hora_venta' ,
    ];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
