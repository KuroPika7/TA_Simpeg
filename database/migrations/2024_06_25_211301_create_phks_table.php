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
        Schema::create('phks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawans_id')->constrained('karyawans')->cascadeOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('document_url')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('1')
                ->comment('0 : Ditolak, 1 : Pending, 2 : Diterima');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('karyawans')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('karyawans')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phks');
    }
};
