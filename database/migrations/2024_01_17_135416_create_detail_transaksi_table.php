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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail');
            $table->string('no_transaksi');
            $table->foreign('no_transaksi')->references('no_transaksi')->on('transaksi');
            $table->string('kode_produksi');
            $table->foreign('kode_produksi')->references('kode_produksi')->on('barang');
            $table->string('grade');
            $table->integer('quantity');
            $table->date('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
