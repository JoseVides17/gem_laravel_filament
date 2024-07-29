<?php

namespace App\Filament\Resources\ExamenResource\Pages;

use App\Filament\Resources\ExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExamen extends EditRecord
{
    protected static string $resource = ExamenResource::class;

    protected static ?string $title = 'Editar Examen';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
