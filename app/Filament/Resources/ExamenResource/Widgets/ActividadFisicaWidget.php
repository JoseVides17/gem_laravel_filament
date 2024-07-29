<?php

namespace App\Filament\Resources\ExamenResource\Widgets;

use App\Models\Examen;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ActividadFisicaWidget extends ChartWidget
{
    protected static ?string $heading = 'Exámenes por Actividad Física e Interpretación';

    protected function getData(): array
    {
        $userCdId = auth()->user()->cd_id;

        $examenesPorActividadEInterpretacion = Examen::select(
            'actividad_fisica',
            'interpretacion',
            DB::raw('count(*) as count')
        )
            ->whereHas('empleado', function ($query) use ($userCdId) {
                $query->where('cd_id', $userCdId);
            })
            ->groupBy('actividad_fisica', 'interpretacion')
            ->get();

        $labels = [];
        $datasets = [
            'Sí' => [],
            'No' => [],
        ];

        foreach ($examenesPorActividadEInterpretacion as $item) {
            $actividad = $item->actividad_fisica == 1 ? 'Sí' : 'No';
            $interpretacion = $item->interpretacion;

            if (!in_array($interpretacion, $labels)) {
                $labels[] = $interpretacion;
            }

            $datasets[$actividad][$interpretacion] = $item->count;
        }

        foreach ($labels as $label) {
            if (!isset($datasets['Sí'][$label])) {
                $datasets['Sí'][$label] = 0;
            }
            if (!isset($datasets['No'][$label])) {
                $datasets['No'][$label] = 0;
            }
        }

        foreach ($datasets as &$dataset) {
            $dataset = array_values(array_replace(array_flip($labels), $dataset));
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Sí',
                    'data' => $datasets['Sí'],
                    'backgroundColor' => '#FF6384',
                ],
                [
                    'label' => 'No',
                    'data' => $datasets['No'],
                    'backgroundColor' => '#36A2EB',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
