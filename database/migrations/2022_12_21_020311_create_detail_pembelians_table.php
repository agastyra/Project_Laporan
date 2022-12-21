<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            // $table->int('transaction_id', 5); diganti oleh rangga
            $table->foreignId('transaksi_pembelians_id');
            $table->foreignId('barangs_id');
            // $table->int('barang_id', 5); diganti oleh rangga
            $table->integer('qty', 4)->default(0);
            $table->double('sub_total')->default(0);
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
        Schema::dropIfExists('detail_pembelians');
    }
}
