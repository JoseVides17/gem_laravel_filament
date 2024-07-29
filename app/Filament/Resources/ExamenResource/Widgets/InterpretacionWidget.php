<?php

namespace App\Filament\Resources\ExamenResource\Widgets;

use App\Models\Examen;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class InterpretacionWidget extends ChartWidget
{
    protected static ?string $heading = 'Exámenes por Interpretación';

    protected function getData(): array
    {
        $userCdId = auth()->user()->cd_id;

        $examenesPorInterpretacion = Examen::select('interpretacion', DB::raw('count(*) as count'))
            ->whereHas('empleado', function ($query) use ($userCdId) {
                $query->where('cd_id', $userCdId);
            })
            ->groupBy('interpretacion')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->interpretacion => $item->count];
            })
            ->toArray();

        $data = [
            'labels' => array_keys($examenesPorInterpretacion),
            'values' => array_values($examenesPorInterpretacion),
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
