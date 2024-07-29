<?php

namespace App\Models;

use App\Models\Scopes\TipoExamenScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoExamen extends Model
{
    use HasFactory;

    //protected static function booted()
    //{
    //    static::addGlobalScope(new TipoExamenScope());
    //}

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }
}
