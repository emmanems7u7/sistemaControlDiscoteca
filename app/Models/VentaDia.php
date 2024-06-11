<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDia extends Model
{
    use HasFactory;

   
protected $fillable = [
    'fecha',
    'piso_id',
    'monto',
];

public function piso()
{
    return $this->belongsTo(Piso::class);
}

// Método para obtener la fecha en español
public function getFechaLiteralAttribute()
{
    return Carbon::parse($this->attributes['fecha'])->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
}
}
