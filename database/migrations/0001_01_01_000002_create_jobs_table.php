<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration class for creating tables related to job queue management.
 */
return new class extends Migration
{
    /**
     * Runs the migration to create the `jobs`, `job_batches`, and `failed_jobs` tables.
     *
     * @return void
     */
    public function up(): void
    {
        // Creation of the 'jobs' table to store queued jobs
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Unique job identifier
            $table->string('queue')->index(); // Name of the queue where the job is located
            $table->longText('payload'); // Serialized job information
            $table->unsignedTinyInteger('attempts'); // Number of execution attempts
            $table->unsignedInteger('reserved_at')->nullable(); // Timestamp when the job was reserved
            $table->unsignedInteger('available_at'); // Timestamp when the job becomes available
            $table->unsignedInteger('created_at'); // Job creation timestamp
        });

        // Creation of the 'job_batches' table to manage job queue batches
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary(); // Unique batch identifier
            $table->string('name'); // Name of the job batch
            $table->integer('total_jobs'); // Total number of jobs in the batch
            $table->integer('pending_jobs'); // Number of pending jobs
            $table->integer('failed_jobs'); // Number of failed jobs
            $table->longText('failed_job_ids'); // List of failed job IDs
            $table->mediumText('options')->nullable(); // Additional batch options
            $table->integer('cancelled_at')->nullable(); // Batch cancellation timestamp
            $table->integer('created_at'); // Batch creation timestamp
            $table->integer('finished_at')->nullable(); // Batch completion timestamp
        });

        // Creation of the 'failed_jobs' table to record failed jobs
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Unique failed job identifier
            $table->string('uuid')->unique(); // Universally unique identifier (UUID) for the job
            $table->text('connection'); // Connection used for the queue
            $table->text('queue'); // Queue name
            $table->longText('payload'); // Serialized job information
            $table->longText('exception'); // Error message associated with the failure
            $table->timestamp('failed_at')->useCurrent(); // Timestamp when the job failed
        });
    }

    /**
     * Reverses the migration by deleting the created tables.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs'); // Deletes the jobs table
        Schema::dropIfExists('job_batches'); // Deletes the job batches table
        Schema::dropIfExists('failed_jobs'); // Deletes the failed jobs table
    }
};
