<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function show($id)
    {
        $empleado = Empleado::with('examenes')->findOrFail($id);
        return view('empleados.detalles', compact('empleado'));
    }
}
