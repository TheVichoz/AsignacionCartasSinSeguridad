<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for the "dispositivos" table.
 * 
 * This table stores information about devices, including their serial number and category.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the "dispositivos" table.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id(); // Unique device identifier (auto-increment)
            $table->string('numero_serie')->unique(); // Unique serial number of the device
            $table->string('categoria'); // Category to which the device belongs
            $table->timestamps(); // Timestamp fields (created_at and updated_at)
        });
    }

    /**
     * Reverses the migration by deleting the "dispositivos" table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
