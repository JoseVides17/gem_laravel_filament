<?php

namespace App\Filament\Resources\EmpleadoResource\Pages;

use App\Filament\Resources\EmpleadoResource;
use App\Models\Empleado;
use Filament\Resources\Pages\Page;

class ViewEmpleado extends Page
{
    protected static string $resource = EmpleadoResource::class;

    public Empleado $record;

    public function mount($record): void
    {
        $this->record = Empleado::with('examenes')->findOrFail($record);
    }

    public function getTitle(): string
    {
        return $this->record->nombres . ' ' . $this->record->apellidos;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Añade widgets si es necesario
        ];
    }

    protected function getActions(): array
    {
        return [
            // Añade acciones si es necesario
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.resources.empleado-resource.pages.view-empleado', [
            'empleado' => $this->record,
        ]);
    }
}
