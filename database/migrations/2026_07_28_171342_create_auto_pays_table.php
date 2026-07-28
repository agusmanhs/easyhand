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
        Schema::create('auto_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('customer_no');
            $table->string('zone_id')->nullable(); // For games
            
            // Scheduling config
            $table->enum('schedule_type', ['daily', 'weekly', 'monthly']);
            $table->integer('schedule_day')->nullable(); // 1-31 for monthly, 1-7 for weekly
            $table->time('schedule_time'); // HH:MM:00
            
            // Status and tracking
            $table->boolean('status')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_pays');
    }
};
