<x-filament::page>
    <div class="container">
        <h1>{{ $empleado->nombres }} {{ $empleado->apellidos }}</h1>
        <p>Cédula: {{ $empleado->cedula }}</p>
        <p>Cargo: {{ $empleado->cargo }}</p>
        <p>Departamento: {{ $empleado->departamento }}</p>
        <!-- Agrega más campos según sea necesario -->

        <h2>Exámenes Médicos</h2>
        <ul>
            @foreach ($empleado->examenes as $examen)
                <li>{{ $examen->nombre }} - {{ $examen->fecha_realizacion }}</li>
            @endforeach
        </ul>
    </div>
</x-filament::page>
