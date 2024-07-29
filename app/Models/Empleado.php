<?php

namespace App\Models;

use App\Models\Scopes\EmpleadoScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    //protected static function booted()
    //{
    //    static::addGlobalScope(new EmpleadoScope());
   // }

    protected $fillable = [
        'cd_id',
        'cedula',
        'nombres',
        'apellidos',
        'foto_perfil',
        'carta_recomendacion',
        'concepto_medico',
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
