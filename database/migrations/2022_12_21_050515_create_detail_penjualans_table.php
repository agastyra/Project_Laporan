<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction');
            $table->unsignedBigInteger('barangs_id');
            $table->double('harga_jual');
            $table->integer('qty')->default(1);
            $table->double('subTotal')->default(0);
            $table->timestamps();

            $table->foreign('no_transaction')->references('no_transaction')->on('transaksi_penjualans');
            $table->foreign('barangs_id')->references('id')->on(' barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
