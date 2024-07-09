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
        Schema::create('campañas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cd_id')->constrained('c_d_s');
            $table->string('nombre');
            $table->date('fecha_realizacion');
            $table->string('evidencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campañas');
    }
};
