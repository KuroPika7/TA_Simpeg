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
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('agama');
            $table->string('pendidikan')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->enum('status', ['0', '1', '2' ])->default('1')
                ->comment('0 : Ditolak, 1 : Dilamar, 2 : Diterima');
            $table->enum('gender', ['Lk', 'Pr'])->nullable();
            $table->string('image_url')->nullable();
            $table->string('document_url')->nullable();
            $table->string('lowongan_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
