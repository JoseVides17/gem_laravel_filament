<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'nombre_empleado',
        'fecha_previa',
        'fecha_realizacion',
        'fecha_vencimiento',
        'tipo_examen_id',
        'dias_disponibles',
        'estatus',
        'enfasis',
        'lesion',
        'fuma',
        'CIG_DIA',
        'consumo',
        'psicoactivos',
        'actividad_fisica',
        'tipo_actividad_fisica',
        'peso',
        'talla',
        'imc',
        'interpretacion',
        'valoracion',
        'recomendacion_general',
        'recomendacion_ocupacional',
        'recomendacion_medica',
        'seguimiento',
        'restricciones',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function tipoExamen()
    {
        return $this->belongsTo(TipoExamen::class);
    }
}
