<?php

namespace App\Filament\Resources\ExamenResource\Widgets;

use App\Models\Examen;
use App\Models\TipoExamen;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ExamenWidget extends ChartWidget
{
    protected static ?string $heading = 'Estadísticas de Exámenes';

    protected function getData(): array
    {
        $userCdId = auth()->user()->cd_id;

        $examenesPorMesYTipo = Examen::select(
            DB::raw('DATE_FORMAT(fecha_realizacion, "%Y-%m") as month'),
            'tipo_examen_id',
            DB::raw('count(*) as count')
        )
            ->whereHas('empleado', function ($query) use ($userCdId) {
                $query->where('cd_id', $userCdId);
            })
            ->groupBy('month', 'tipo_examen_id')
            ->orderBy('month')
            ->get();

        $tiposDeExamen = TipoExamen::pluck('nombre', 'id')->toArray();
        $data = [
            'labels' => [],
            'datasets' => [],
        ];

        $groupedByMonth = $examenesPorMesYTipo->groupBy('month');

        foreach ($groupedByMonth as $month => $examenes) {
            $data['labels'][] = $this->formatMonth($month);
        }

        $predefinedColors = [
            1 => '#FF6384',
            2 => '#36A2EB',
            // Añade más colores según el número de tipos de examen
        ];

        $datasets = [];
        foreach ($tiposDeExamen as $tipoId => $tipoNombre) {
            $color = $predefinedColors[$tipoId] ?? '#000000';
            $datasets[$tipoId] = [
                'label' => $tipoNombre,
                'data' => array_fill(0, count($data['labels']), 0),
                'borderColor' => $color,
                'backgroundColor' => $color,
            ];
        }

        foreach ($groupedByMonth as $month => $examenes) {
            foreach ($examenes as $examen) {
                $index = array_search($this->formatMonth($month), $data['labels']);
                if ($index !== false) {
                    $datasets[$examen->tipo_examen_id]['data'][$index] = $examen->count;
                }
            }
        }

        foreach ($datasets as $dataset) {
            $data['datasets'][] = $dataset;
        }

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function formatMonth($month)
    {
        $date = \DateTime::createFromFormat('Y-m', $month);
        return $date->format('F Y');
    }
}
