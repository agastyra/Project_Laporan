<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuktiKasKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_kas_keluars', function (Blueprint $table) {
            $table->id();
            $table->Date('tanggal');
            $table->foreignId('transaksi_pembelians_id');
            $table->string('description');
            $table->string('is_other');
            $table->string('other_account');
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
        Schema::dropIfExists('bukti_kas_keluars');
    }
}