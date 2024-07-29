<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ExamenResource\Widgets\ActividadFisicaWidget;
use App\Filament\Resources\ExamenResource\Widgets\ExamenWidget;
use App\Filament\Resources\ExamenResource\Widgets\InterpretacionWidget;
use App\Filament\Resources\ExamenResource\Widgets\PVEWidget;
use App\Models\Empleado;
use Filament\Pages\Page;

class MyDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static string $view = 'filament.pages.my-dashboard';
    protected static ?string $title = 'Graficas';

    public function getWidgets(): array
    {
        if (!auth()->check())
            return [];

        $user = auth()->user();

        if (!$user->cd_id)
            return [];

        $empleado = Empleado::with('cd')->where('cd_id', $user->cd_id)->first();

        if ($empleado && $empleado->cd_id === $user->cd_id) {
            return [
                ExamenWidget::class,
                ActividadFisicaWidget::class,
                PVEWidget::class,
                InterpretacionWidget::class,
            ];
        }
        return [];
    }
}
