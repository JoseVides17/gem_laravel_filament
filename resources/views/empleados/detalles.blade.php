@extends('layouts.app')

@section('title', 'Detalles')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 relative">
            <div class="flex items-start mb-4">
                <div class="flex flex-col">
                    <h1 class="text-lg mb-2"><strong>Empleado:</strong> {{ $empleado->nombres . ' ' . $empleado->apellidos }}</h1>
                    <p class="text-lg mb-2"><strong>Cargo:</strong> {{ $empleado->cargo }}</p>
                </div>
                <div class="absolute top-6 right-3">
                    @if($empleado->foto_perfil)
                        <img src="{{ asset('storage/' . $empleado->foto_perfil) }}" alt="Profile Image" class="w-28 h-28 rounded-full mr-4">
                    @else
                        <div class="w-28 h-28 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm text-gray-500">N/A</span>
                        </div>
                    @endif
                </div>
            </div>

            <h2 class="text-2xl font-semibold mt-6 mb-4">Exámenes</h2>
            @if($empleado->examenes->isEmpty())
                <p class="text-gray-600">No hay exámenes disponibles para este empleado.</p>
            @else
                <div class="space-y-4">
                    @foreach ($empleado->examenes as $examen)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <p><strong>Tipo de Examen:</strong> {{ $examen->tipoExamen->nombre }}</p>
                            <p><strong>Fecha de Realizacion:</strong> {{ $examen->fecha_realizacion }}</p>
                            <p><strong>Fecha de Vencimiento:</strong> {{ $examen->fecha_vencimiento }}</p>
                            <p><strong>SVE:</strong> {{ $examen->seguimiento }}</p>
                            <p><strong>Restricciones:</strong> {{ $examen->restricciones }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="flex justify-between mb-2 mt-4">
                <a href="{{ route('filament.admin.pages.dashboard') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-full hover:bg-yellow-700">Volver</a>
                <div class="flex space-x-4">
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($empleado->concepto_medico) }}"
                       class="bg-yellow-600 text-white px-4 py-2 rounded-full hover:bg-yellow-700">Concepto Medico</a>
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($empleado->carta_recomendacion) }}"
                       class="bg-yellow-600 text-white px-4 py-2 rounded-full hover:bg-yellow-700">Carta Recomendacion</a>
                </div>
            </div>
        </div>
    </div>
@endsection

