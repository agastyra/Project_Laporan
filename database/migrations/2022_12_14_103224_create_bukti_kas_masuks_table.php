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
            $table->date('tanggal');
            $table->foreignId('id_transaksi_pembelian');
            $table->string('description');
            $table->string('is_other');
            $table->string('other_acccount');
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