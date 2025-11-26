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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('hostel_blocks')->onDelete('cascade');
            $table->string('room_number', 20);
            $table->integer('floor');
            $table->integer('capacity')->default(2);
            $table->integer('occupied')->default(0);
            $table->enum('room_type', ['single', 'double', 'triple', 'quad']);
            $table->decimal('price_per_semester', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('has_bathroom')->default(true);
            $table->boolean('has_balcony')->default(false);
            $table->enum('status', ['available', 'occupied', 'full', 'maintenance'])->default('available');
            $table->timestamps();

            $table->unique(['block_id', 'room_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
