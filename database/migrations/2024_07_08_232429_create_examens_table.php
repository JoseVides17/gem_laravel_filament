<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained('empleados');
            $table->string('nombre_empleado');
            $table->date('fecha_previa');
            $table->date('fecha_realizacion');
            $table->date('fecha_vencimiento');
            $table->foreignId('tipo_examen_id')->constrained('tipo_examens');
            $table->integer('dias_disponibles');
            $table->string('estatus');
            $table->string('enfasis');
            $table->string('lesion')->nullable();
            $table->boolean('fuma')->nullable();
            $table->string('CIG_DIA')->nullable();
            $table->string('consumo')->nullable();
            $table->boolean('psicoactivos')->nullable();
            $table->boolean('actividad_fisica')->nullable();
            $table->string('tipo_actividad_fisica')->nullable();
            $table->float('peso')->nullable();
            $table->float('talla')->nullable();
            $table->float('imc')->nullable();
            $table->string('interpretacion')->nullable();
            $table->string('valoracion')->nullable();
            $table->text('recomendacion_general')->nullable();
            $table->text('recomendacion_ocupacional')->nullable();
            $table->text('recomendacion_medica')->nullable();
            $table->text('seguimiento')->nullable();
            $table->string('restricciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
