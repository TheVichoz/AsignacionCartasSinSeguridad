<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('display_name');
            $table->string('email')->unique();
            $table->string('location');
            $table->string('cost_center_account_number')->nullable();
            $table->string('cost_center_name')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('position')->nullable();
            $table->string('nombre')->nullable();
$table->string('centro')->nullable();
$table->string('correo')->nullable(); // Por si no lo tienes

            $table->string('type')->default('enduser');
            $table->string('password')->nullable(); // opcional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
