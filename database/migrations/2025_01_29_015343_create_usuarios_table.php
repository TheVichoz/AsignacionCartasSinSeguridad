<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for the "usuarios" table.
 * 
 * This table stores user information, including name, supervisor,
 * workplace center, email, and location.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the "usuarios" table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Unique user identifier
            $table->string('nombre'); // Full name of the user
            $table->string('supervisor'); // Name of the direct supervisor
            $table->string('centro'); // Workplace center to which the user belongs
            $table->string('correo')->unique(); // Email address (unique per user)
            $table->string('ubicacion'); // Physical location of the user
            $table->timestamps(); // Timestamp fields (created_at and updated_at)
        });
    }

    /**
     * Reverses the migration by deleting the "usuarios" table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
