<x-filament::page>
    @if ($empleado)
        <h2 class="text-xl font-semibold">Exámenes de {{ $empleado->nombres }} {{ $empleado->apellidos }}</h2>
        <ul>
            @forelse ($examenes as $examen)
                <li>{{ $examen->tipoExamen->nombre }} - {{ $examen->fecha_realizacion }}</li>
            @empty
                <li>No hay exámenes registrados para este empleado.</li>
            @endforelse
        </ul>
    @else
        <p>No se encontró información del empleado.</p>
    @endif
</x-filament::page>

