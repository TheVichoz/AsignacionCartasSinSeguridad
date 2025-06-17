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
    Schema::table('tecnicos', function (Blueprint $table) {
        $table->string('user_id')->unique()->nullable();
        $table->string('name')->nullable();
        $table->string('display_name')->nullable();
        $table->string('email')->unique()->nullable();
        $table->string('position')->nullable();
        $table->string('location')->nullable();
        $table->string('cost_center_account_number')->nullable();
        $table->string('cost_center_name')->nullable();
        $table->string('supervisor')->nullable();
        $table->string('type')->nullable();
        $table->string('password')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('tecnicos', function (Blueprint $table) {
        $table->dropColumn([
            'user_id',
            'name',
            'display_name',
            'email',
            'position',
            'location',
            'cost_center_account_number',
            'cost_center_name',
            'supervisor',
            'type',
            'password',
        ]);
    });
}

};
