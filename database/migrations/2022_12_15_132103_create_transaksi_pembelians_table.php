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
<<<<<<< HEAD
            $table->id(); # ditambahkan oleh rangga
            $table->integer('no_transaction', 5); # direlasikan ke bukti kas keluar
            $table->date('date');
            $table->string('vendor', 50)->default("");
            $table->double('grand_total')->default(0);
            $table->double('diskon')->default(0);
            $table->double('bayar')->default(0);
            $table->double('kembali')->default(0);
=======
            $table->id();
            $table->integer('no_transaksi', 4);
            $table->date('tanggal');
            $table->string('vendor', 35);
            $table->double('gtotal');
            $table->double('pot_harga');
>>>>>>> 8fea5a86bf60bca47033f69e51a76ade6ccdb752
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
