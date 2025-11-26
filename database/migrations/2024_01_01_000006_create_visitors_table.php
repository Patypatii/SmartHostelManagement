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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null');
            $table->string('visitor_name');
            $table->string('visitor_phone', 20);
            $table->string('visitor_id_number', 50)->nullable();
            $table->text('purpose_of_visit')->nullable();
            $table->timestamp('entry_time');
            $table->timestamp('expected_exit_time')->nullable();
            $table->timestamp('actual_exit_time')->nullable();
            $table->enum('status', ['pending', 'approved', 'checked_in', 'checked_out', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
