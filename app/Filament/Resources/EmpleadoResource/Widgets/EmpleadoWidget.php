<?php

namespace App\Filament\Resources\EmpleadoResource\Widgets;

use App\Models\Empleado;
use Filament\Widgets\Widget;

class EmpleadoWidget extends Widget
{
    protected static string $view = 'filament.resources.empleado-resource.widgets.empleado-widget';

    public $empleados;
    public function mount()
    {
        $this->empleados = Empleado::all();
    }
}
