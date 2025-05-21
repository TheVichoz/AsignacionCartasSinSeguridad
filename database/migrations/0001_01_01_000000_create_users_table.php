<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for creating tables related to user authentication.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the `users`, `password_reset_tokens`, and `sessions` tables.
     *
     * @return void
     */
    public function up(): void
    {
        // Creation of the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // User name
            $table->string('email')->unique(); // Unique email address
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // Encrypted password
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Creation and update timestamps
        });

        // Creation of the 'password_reset_tokens' table to manage password resets
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key based on email
            $table->string('token'); // Password reset token
            $table->timestamp('created_at')->nullable(); // Token creation timestamp
        });

        // Creation of the 'sessions' table to store user sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Unique session identifier
            $table->foreignId('user_id')->nullable()->index(); // Relationship with the `users` table
            $table->string('ip_address', 45)->nullable(); // User's IP address
            $table->text('user_agent')->nullable(); // Browser/device information
            $table->longText('payload'); // Serialized session data
            $table->integer('last_activity')->index(); // Last session activity
        });
    }

    /**
     * Reverses the migration by deleting the created tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Deletes the users table
        Schema::dropIfExists('password_reset_tokens'); // Deletes the password reset tokens table
        Schema::dropIfExists('sessions'); // Deletes the sessions table
    }
};
