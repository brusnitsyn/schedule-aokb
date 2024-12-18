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
        Schema::create('schedule_items', function (Blueprint $table) {
            $table->id();
            $table->integer('position')->nullable();
            $table->string('doctor_job');
            $table->string('doctor_name');
            $table->string('room');
            $table->unsignedBigInteger('start_at');
            $table->unsignedBigInteger('end_at');
            $table->foreignIdFor(\App\Models\StatusScheduleItem::class)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_items');
    }
};
