<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuktiKasMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_kas_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_bkm');
            $table->date('tanggal');
            $table->foreignId('transaksi_penjualan_id')->nullable();
            $table->foreignId('jurnal_memorial_id')->nullable();
            $table->longText('description');
            $table->double('total');
            // $table->string('other_acccount');
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
        Schema::dropIfExists('bukti_kas_masuks');
    }
}