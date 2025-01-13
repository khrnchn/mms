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
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); // Foreign key for the event
            $table->unsignedBigInteger('user_id'); // Foreign key for the user
            $table->string('role')->default('participant'); // Role of the user in the event
            $table->timestamp('joined_at')->nullable(); // Timestamp when the user joined the event
            $table->string('status')->default('pending'); // Status of the registration (e.g., pending, active, inactive)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participants');
    }
};
