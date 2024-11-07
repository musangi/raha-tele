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
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable(); // e.g., male, female, non-binary
            $table->string('location')->nullable(); // City, state
            $table->string('bio', 500)->nullable(); // Short biography or description
            $table->string('phone_number')->nullable();
            $table->string('availability')->nullable(); // e.g., available, not available
            $table->decimal('hourly_rate', 8, 2)->nullable(); // Rate per hour
            $table->boolean('is_escort')->default(false); // Whether the user is an escort
            $table->boolean('is_verified')->default(false); // Whether profile is verified by admin
            $table->rememberToken();
            $table->timestamps();
        });

        // Password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // User preferences table
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('preferred_gender')->nullable(); // Gender preference
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->string('location_preference')->nullable();
            $table->timestamps();
        });

        // User services table
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable(); // Price for the service
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_services');
        Schema::dropIfExists('user_preferences');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};