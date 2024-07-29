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
        'team_id'
    ];
    public function campañas()
    {
        return $this->hasMany(Campaña::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
