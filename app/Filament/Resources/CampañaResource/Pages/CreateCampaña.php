<?php

namespace App\Filament\Resources\CampañaResource\Pages;

use App\Filament\Resources\CampañaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCampaña extends CreateRecord
{
    protected static string $resource = CampañaResource::class;

    protected static ?string $title = 'Guardar Campaña';
}
