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
        $table->id();
        $table->string('user_id')->unique();
        $table->string('name');
        $table->string('display_name');
        $table->string('email')->unique();
        $table->string('position')->nullable();
        $table->string('location')->nullable();
        $table->string('cost_center_account_number')->nullable();
        $table->string('cost_center_name')->nullable();
        $table->string('supervisor')->nullable();
        $table->string('type')->nullable();
        $table->string('password');
        $table->timestamps();
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
