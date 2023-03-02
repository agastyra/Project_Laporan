<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalPenyesuaianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_penyesuaian_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_penyesuaian_id');
            $table->foreignId('akun_id');
            $table->double('debet')->nullable()->default(0);
            $table->double('kredit')->nullable()->default(0);
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
        Schema::dropIfExists('jurnal_penyesuaian_details');
    }
}