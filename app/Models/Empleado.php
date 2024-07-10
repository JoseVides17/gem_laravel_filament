<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cd_id',
        'cedula',
        'nombres',
        'apellidos',
        'foto_perfil',
        'fecha_nacimiento',
        'sexo',
        'edad',
        'cargo',
        'departamento',
        'eps',
        'estado_civil',
        'direccion',
        'ciudad',
        'estado',
    ];

    public function cd()
    {
        return $this->belongsTo(CD::class, 'cd_id');
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }
}
