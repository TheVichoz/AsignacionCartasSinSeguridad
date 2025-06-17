<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('user_id')->unique()->nullable();
            $table->string('display_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('location')->nullable();
            $table->string('cost_center_account_number')->nullable();
            $table->string('cost_center_name')->nullable();
            $table->string('position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'display_name',
                'email',
                'location',
                'cost_center_account_number',
                'cost_center_name',
                'position',
            ]);
        });
    }
};
