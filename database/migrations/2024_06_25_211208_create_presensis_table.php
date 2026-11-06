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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawans_id')->constrained('karyawans')->cascadeOnDelete();
            $table->string('image_url')->nullable();
            $table->dateTime('clock_at')->nullable();
            $table->string('clock_in_location')->nullable();
            $table->string('type');
            $table->string('alasan_izin')->nullable();
            $table->string('status')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
