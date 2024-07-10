<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CD extends Model
{
    use HasFactory;

    protected $fillable = [
        'nit',
        'nombre',
        'ubicacion',
    ];

    public function campañas()
    {
        return $this->hasMany(Campaña::class);
    }
}
