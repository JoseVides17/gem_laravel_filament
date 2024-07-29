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
        Schema::table('examens', function (Blueprint $table) {

            $table->dropForeign(['empleado_id']);

            $table->foreign('empleado_id')
                ->references('id')->on('empleados')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->dropForeign(['tipo_examen_id']);

            $table->foreign('tipo_examen_id')
                ->references('id')->on('tipo_examens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->foreignId('empleado_id')
                ->constrained('empleados');

            $table->dropForeign(['tipo_examen_id']);
            $table->foreignId('tipo_examen_id')
                ->constrained('tipo_examen');
        });
    }
};
