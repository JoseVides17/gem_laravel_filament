<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empleado;
use Carbon\Carbon;

class ActualizarEdadEmpleados extends Command
{
    protected $signature = 'empleados:actualizar-edad';
    protected $description = 'Actualizar la edad de los empleados según su fecha de nacimiento';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $empleados = Empleado::all();

        foreach ($empleados as $empleado) {
            if ($empleado->fecha_nacimiento) {
                $edad = Carbon::parse($empleado->fecha_nacimiento)->age;
                $empleado->edad = $edad;
                $empleado->save();
            }
        }

        $this->info('Edad de los empleados actualizada correctamente.');
    }
}

