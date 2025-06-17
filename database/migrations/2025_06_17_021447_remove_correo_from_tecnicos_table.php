<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations: elimina la columna 'correo' de la tabla 'tecnicos'.
     */
    public function up(): void
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->dropColumn('correo');
        });
    }

    /**
     * Revert the migrations: vuelve a agregar la columna 'correo' si se revierte.
     */
    public function down(): void
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->string('correo')->unique();
        });
    }
};
