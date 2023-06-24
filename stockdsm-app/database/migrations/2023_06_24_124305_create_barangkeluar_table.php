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
        Schema::create('barangkeluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_keluar');
            $table->unsignBigInteger('id_barang');
            $table->foreign('id_barang')->reference('id')->on('barang');
            $table->integer('jumlah_barang');
            $table->text('keterangan_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangkeluar');
    }
};
