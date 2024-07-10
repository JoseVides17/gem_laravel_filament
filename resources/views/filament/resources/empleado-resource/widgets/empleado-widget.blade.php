<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="header">
            <h2 class="text-2xl font-bold">Empleados</h2>
        </x-slot>
        <div class="flex flex-wrap gap-6">
            @foreach ($empleados as $empleado)
                <x-filament::card>
                    <div class="flex items-center">
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
                            <p class="font-bold text-lg">{{ $empleado->nombres }}</p>
                            <p class="text-sm text-gray-600">{{ $empleado->cargo }}</p>
                        </div>
                    </div>
                </x-filament::card>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
