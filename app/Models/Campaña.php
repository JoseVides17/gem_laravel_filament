<?php

namespace App\Models;

use App\Models\Scopes\CampañaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory;

    //protected static function booted()
    //{
    //    static::addGlobalScope(new CampañaScope);
    //}

    protected $fillable = [
        'cd_id',
        'nombre',
        'fecha_realizacion',
        'evidencia',
    ];

    public function cd()
    {
        return $this->belongsTo(CD::class);
    }
}
