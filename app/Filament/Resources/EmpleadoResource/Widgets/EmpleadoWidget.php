<?php

namespace App\Filament\Resources\EmpleadoResource\Widgets;

use App\Filament\Resources\ExamenResource\Widgets\ActividadFisicaWidget;
use App\Filament\Resources\ExamenResource\Widgets\ExamenWidget;
use App\Filament\Resources\ExamenResource\Widgets\InterpretacionWidget;
use App\Filament\Resources\ExamenResource\Widgets\PVEWidget;
use App\Models\Empleado;
use Filament\Widgets\Widget;

class EmpleadoWidget extends Widget
{
    protected static string $view = 'filament.resources.empleado-resource.widgets.empleado-widget';

    public $empleados;
    public function mount()
    {
        $this->empleados = Empleado::whereHas('examenes')
            ->orderBy('nombres', 'asc')
            ->get();
    }
}
