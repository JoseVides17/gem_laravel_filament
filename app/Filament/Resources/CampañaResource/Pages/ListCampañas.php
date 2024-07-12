<?php

namespace App\Filament\Resources\CampañaResource\Pages;

use App\Filament\Resources\CampañaResource;
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
