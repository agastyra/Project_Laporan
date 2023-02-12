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
            $table->foreignId('transaksi_pembelian_id')->nullable();
            $table->text('description');
            $table->boolean('is_other')->nullable()->default(false);
            $table->foreignId('akun_id')->nullable();
            $table->double('akun_amount')->nullable()->default(0);
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
