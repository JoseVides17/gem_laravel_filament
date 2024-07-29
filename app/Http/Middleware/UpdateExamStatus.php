<?php

namespace App\Http\Middleware;

use App\Models\Empleado;
use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateExamStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $empleados = Empleado::all();
            $today = Carbon::today();

            foreach ($empleados as $empleado) {
                foreach ($empleado->examenes as $examen) {
                    $fechaVencimiento = Carbon::parse($examen->fecha_vencimiento);
                    $diasDisponibles = $today->diffInDays($fechaVencimiento, false);

                    $examen->dias_disponibles = $diasDisponibles;

                    if ($diasDisponibles > 0) {
                        $examen->estatus = 'Vigente';
                    } else {
                        $examen->estatus = 'Vencido';
                    }

                    $examen->save();
                }
            }
        }

        return $next($request);
    }
}
