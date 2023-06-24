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
        Schema::create('barangmasukdetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barangmasuk');
            $table->foreign('id_barangmasuk')->references('id')->on('barangmasuk');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->integer('jumlah_barang');
            $table->text('keterangan_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangmasukdetail');
    }
};
