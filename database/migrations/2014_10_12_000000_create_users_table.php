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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'student', 'staff'])->default('student');
            $table->string('phone', 20)->nullable();
            $table->string('student_id', 50)->nullable()->unique();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('course')->nullable();
            $table->integer('year_of_study')->nullable();
            $table->string('profile_photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
