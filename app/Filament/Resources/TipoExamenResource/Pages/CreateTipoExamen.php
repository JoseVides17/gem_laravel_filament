<?php

namespace App\Filament\Resources\TipoExamenResource\Pages;

use App\Filament\Resources\TipoExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoExamen extends CreateRecord
{
    protected static string $resource = TipoExamenResource::class;

    protected static ?string $title = 'Crear Tipo de examen';
}
