<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalPiso extends Model
{
    use HasFactory;
    protected $fillable = [
        'piso_id',
        'user_id',
    ];
   
}
