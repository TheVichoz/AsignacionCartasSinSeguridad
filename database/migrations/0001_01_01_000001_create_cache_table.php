<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for creating cache tables in the database.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the `cache` and `cache_locks` tables.
     *
     * @return void
     */
    public function up(): void
    {
        // Creation of the 'cache' table to store cached data
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Unique key identifying each cache entry
            $table->mediumText('value'); // Stored cache value
            $table->integer('expiration'); // Cache expiration time in seconds
        });

        // Creation of the 'cache_locks' table to manage cache locks
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Unique key identifying locks
            $table->string('owner'); // Identifier of the lock owner
            $table->integer('expiration'); // Lock expiration time in seconds
        });
    }

    /**
     * Reverses the migration by deleting the created tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cache'); // Deletes the cache table
        Schema::dropIfExists('cache_locks'); // Deletes the cache locks table
    }
};
