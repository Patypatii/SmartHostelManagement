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
        Schema::create('hostel_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 10)->unique();
            $table->enum('gender', ['male', 'female', 'mixed']);
            $table->integer('total_floors');
            $table->integer('total_rooms');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_blocks');
    }
};
