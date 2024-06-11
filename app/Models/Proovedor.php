<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proovedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'direccion',
        'persona_contacto',
        'correo',
        'telefono',
    ];
        
}
