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
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('perihal_surat');
            $table->text('deskripsi'); // The task instruction
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade'); // The employee assigned
            $table->unsignedBigInteger('assigner_id'); // ID of the user who assigned the task
            $table->string('document_url')->nullable(); // Attachment from assigner
            $table->string('submission_file')->nullable(); // File uploaded by employee
            $table->text('submission_note')->nullable(); // Note from employee
            $table->string('status')->default('Pending'); // Pending, Submitted, Approved, Rejected
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasans');
    }
};
