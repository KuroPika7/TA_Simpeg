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
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('nip', 50)->nullable()->unique()->after('id')->comment('Nomor Induk Pegawai');
            $table->string('departemen')->nullable()->after('jabatan_id');
            $table->date('tanggal_masuk')->nullable()->after('status');
            $table->decimal('gaji', 15, 2)->nullable()->after('tanggal_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn(['nip', 'departemen', 'tanggal_masuk', 'gaji']);
        });
    }
};
