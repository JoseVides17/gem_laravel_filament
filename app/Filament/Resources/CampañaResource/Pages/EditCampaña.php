<?php

namespace App\Filament\Resources\CampañaResource\Pages;

use App\Filament\Resources\CampañaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCampaña extends EditRecord
{
    protected static string $resource = CampañaResource::class;

    protected static ?string $title = 'Editar Campaña';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
