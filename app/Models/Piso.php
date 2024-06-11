<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Piso extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
    ];
      // Relación muchos a muchos con User
      public function users(): BelongsToMany
      {
          return $this->belongsToMany(User::class, 'personal_pisos')->withTimestamps();
      }
      public function ventasDia()
      {
          return $this->hasMany(VentaDia::class);
      }
}
