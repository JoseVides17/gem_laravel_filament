<x-filament::page>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; height: 200px">
            @foreach ($this->getWidgets() as $widget)
                <div style="padding: 1rem; border: 1px solid #ccc; border-radius: 0.5rem;">
                    @livewire($widget)
                </div>
            @endforeach
        </div>
</x-filament::page>

