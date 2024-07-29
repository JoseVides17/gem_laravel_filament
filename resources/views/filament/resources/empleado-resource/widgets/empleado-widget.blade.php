<x-filament-widgets::widget>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">Empleados</h2>
    </x-slot>
    <div class="flex flex-wrap gap-6">
            @foreach ($empleados as $empleado)
            @if(auth()->check() && auth()->user()->cd_id === $empleado->cd_id)
                <div class="flex-1" style="display: inline-grid">
                    <div>
                        @if ($empleado->foto_perfil)
                            <img src="{{ '/storage/' . $empleado->foto_perfil }}" alt="{{ $empleado->nombres }}" class="w-16 h-16 rounded-full">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-sm text-gray-500">N/A</span>
                            </div>
                        @endif
                    </div>
                    <div style="justify-content: center">
                        <p class="font-bold text-lg">{{ explode(' ', $empleado->nombres)[0] }}</p>
                        <p class="font-bold text-lg">{{ explode(' ', $empleado->apellidos)[0] }}</p>
                        @php
                            $ultimoExamen = $empleado->examenes->sortByDesc('fecha_realizacion')->first();
                        @endphp

                        @if ($ultimoExamen)
                            <div class="exam-info">
                                <p class="text-sm text-gray-400">Examen: {{ $ultimoExamen->enfasis }}</p>
                                <p class="text-sm text-gray-400">Fecha Realización: {{ $ultimoExamen->fecha_realizacion}}</p>
                                <p class="text-sm text-gray-400">Fecha Vencimiento: {{ $ultimoExamen->fecha_vencimiento}}</p>
                            </div>
                        @else
                            <p class="text-sm text-gray-400">No tiene exámenes registrados.</p>
                        @endif
                        <a href="{{ route('empleados.detalles', $empleado->id) }}" style="background: #aa5500; color: white; padding: 4px; border-radius: 25px;">Ver Detalles</a>
                    </div>
                </div>
            @endif
            @endforeach
    </div>
</x-filament-widgets::widget>

