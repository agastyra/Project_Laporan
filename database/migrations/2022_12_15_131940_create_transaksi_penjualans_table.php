<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            // $table->id();
            #ganti nama field (rangga)
            $table->integer('no_transaction')->primary();
            $table->date('date');
            $table->unsignedBigInteger('customer_id')->nullable();
            #ganti tipe data (rangga)
            $table->double('sub_total')->default(0);
            $table->double('grand_total')->default(0);
            $table->double('diskon')->default(0);
            $table->double('bayar')->default(0);
            $table->double('kembali')->default(0);
            $table->boolean('valid');
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
        Schema::dropIfExists('transaksi_penjualans');
    }
}
