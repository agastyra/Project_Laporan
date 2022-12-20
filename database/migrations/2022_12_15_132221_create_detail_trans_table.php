<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_trans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_penjualans_Id');
            $table->foreignId('barangs_Id');
            $table->integer('qty');
            $table->bigInteger('subTotal');
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
        Schema::dropIfExists('detail_trans');
    }
}
