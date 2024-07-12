<?php

namespace App\Filament\Resources\CDResource\Pages;

use App\Filament\Resources\CDResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCD extends EditRecord
{
    protected static string $resource = CDResource::class;

    protected static ?string $title = 'Editar CD';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
