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
        Schema::create('table_transaksi', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table ->string('layanan');
            $table ->integer('berat');
            $table ->string('nama_pelanggan');
            $table->enum('keterangan', ['pending', 'proses', 'selesai', 'diambil'])->default('pending');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transaksi');
    }
};
