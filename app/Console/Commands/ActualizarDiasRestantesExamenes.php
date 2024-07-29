<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Examen;
use Carbon\Carbon;

class ActualizarDiasRestantesExamenes extends Command
{
    protected $signature = 'examenes:actualizar-dias-restantes';
    protected $description = 'Actualizar los días restantes hasta la fecha de vencimiento de los exámenes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $examenes = Examen::all();

        foreach ($examenes as $examen) {
            if ($examen->fecha_vencimiento) {
                $diasRestantes = Carbon::now()->diffInDays(Carbon::parse($examen->fecha_vencimiento), false);
                $examen->dias_disponibles = $diasRestantes;
                $examen->save();
            }
        }

        $this->info('Días restantes de los exámenes actualizados correctamente.');
    }
}

