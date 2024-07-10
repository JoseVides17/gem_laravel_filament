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
        Schema::table('campañas', function (Blueprint $table) {
            $table->string('evidencia_1')->after('evidencia')->nullable();
            $table->string('evidencia_2')->after('evidencia_1')->nullable();
            $table->string('evidencia_3')->after('evidencia_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campañas', function (Blueprint $table) {
            $table->dropColumn('evidencia_1');
            $table->dropColumn('evidencia_2');
            $table->dropColumn('evidencia_3');
        });
    }
};
