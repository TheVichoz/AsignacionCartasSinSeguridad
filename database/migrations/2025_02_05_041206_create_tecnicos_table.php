<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for the "tecnicos" table.
 * 
 * This table stores technician information, identifying them by their email address.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the "tecnicos" table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id(); // Unique technician identifier (auto-increment)
            $table->string('correo')->unique(); // Technician's email address (unique)
            $table->timestamps(); // Timestamp fields (created_at and updated_at)
        });
    }

    /**
     * Reverses the migration by deleting the "tecnicos" table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
