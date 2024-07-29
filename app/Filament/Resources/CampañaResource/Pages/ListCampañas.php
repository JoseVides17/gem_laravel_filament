<?php

namespace App\Filament\Resources\CampañaResource\Pages;

use App\Filament\Resources\CampañaResource;
use App\Models\Campaña;
use App\Models\CD;
use App\Models\Empleado;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCampañas extends ListRecords
{
    protected static string $resource = CampañaResource::class;

    protected function getHeaderActions(): array
    {
            return [
                Actions\CreateAction::make(),
            ];
    }
}
