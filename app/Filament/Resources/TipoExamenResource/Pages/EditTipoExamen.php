<?php

namespace App\Filament\Resources\TipoExamenResource\Pages;

use App\Filament\Resources\TipoExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoExamen extends EditRecord
{
    protected static string $resource = TipoExamenResource::class;

    protected static ?string $title = 'Editar Tipo de examen';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
