<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalMemorialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_memorial_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_memorial_id');
            $table->foreignId('akun_id');
            $table->double('debet')->default(0);
            $table->double('kredit')->default(0);
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
        Schema::dropIfExists('jurnal_memorial_details');
    }
}
