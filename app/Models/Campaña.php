<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory;

    protected $fillable = [
        'cd_id',
        'nombre',
        'fecha_realizacion',
        'evidencia',
    ];
}
