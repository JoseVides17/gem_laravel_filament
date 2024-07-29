<?php

namespace App\Filament\Resources\ExamenResource\Widgets;

use App\Models\Examen;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PVEWidget extends ChartWidget
{
    protected static ?string $heading = 'Exámenes por Seguimiento';

    protected function getData(): array
    {
        $userCdId = auth()->user()->cd_id;

        $examenesPorPVE = Examen::select('seguimiento', DB::raw('count(*) as count'))
            ->whereHas('empleado', function ($query) use ($userCdId) {
                $query->where('cd_id', $userCdId);
            })
            ->groupBy('seguimiento')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->seguimiento => $item->count];
            })
            ->toArray();

        $data = [
            'labels' => array_keys($examenesPorPVE),
            'values' => array_values($examenesPorPVE),
        ];

        return [
            'datasets' => [
                [
                    'data' => $data['values'],
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
