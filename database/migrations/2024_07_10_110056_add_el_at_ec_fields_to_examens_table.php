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
            $table->string('enfermedad_laboral')->after('enfasis')->nullable();
            $table->string('accidente_trabajo')->after('enfermedad_laboral')->nullable();
            $table->string('enfermedad_comun')->after('accidente_trabajo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->dropColumn('enfermedad_laboral');
            $table->dropColumn('accidente_trabajo');
            $table->dropColumn('enfermedad_comun');
        });
    }
};
