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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cd_id')->constrained('c_d_s');
            $table->string('cedula')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('foto_perfil')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->integer('edad');
            $table->string('cargo');
            $table->string('departamento');
            $table->string('eps');
            $table->string('estado_civil');
            $table->string('direccion');
            $table->string('ciudad');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
