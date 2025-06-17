<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id')->nullable()->unique();
            $table->string('display_name')->nullable();
            $table->string('location')->nullable();
            $table->string('position')->nullable();
            $table->string('cost_center_account_number')->nullable();
            $table->string('cost_center_name')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('type')->default('employee');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'display_name',
                'location',
                'position',
                'cost_center_account_number',
                'cost_center_name',
                'supervisor',
                'type',
            ]);
        });
    }
};
