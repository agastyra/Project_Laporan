<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction', 6); # direlasikan ke bukti kas keluar
            $table->date('date');
            $table->string('vendor', 50)->nullable()->default("");
            $table->double('grand_total')->nullable()->default(0);
            $table->double('diskon')->nullable()->default(0);
            $table->double('bayar')->nullable()->default(0);
            $table->double('kembali')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pembelians');
    }
}
