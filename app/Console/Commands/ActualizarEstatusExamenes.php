<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Examen;

class ActualizarEstatusExamenes extends Command
{
    protected $signature = 'examenes:actualizar-estatus';
    protected $description = 'Actualizar el estatus de los exámenes según la fecha de vencimiento';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $examenes = Examen::where('estatus', 'vigente')->get();

        foreach ($examenes as $examen) {
            $examen->actualizarEstatus();
        }

        $this->info('Estatus de exámenes actualizado.');
    }
}

