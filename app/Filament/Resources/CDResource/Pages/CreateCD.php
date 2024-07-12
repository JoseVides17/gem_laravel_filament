<?php

namespace App\Filament\Resources\CDResource\Pages;

use App\Filament\Resources\CDResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCD extends CreateRecord
{
    protected static string $resource = CDResource::class;

    protected static ?string $title = 'Crear CD';
}
