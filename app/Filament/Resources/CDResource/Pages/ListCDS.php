<?php

namespace App\Filament\Resources\CDResource\Pages;

use App\Filament\Resources\CDResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCDS extends ListRecords
{
    protected static string $resource = CDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
