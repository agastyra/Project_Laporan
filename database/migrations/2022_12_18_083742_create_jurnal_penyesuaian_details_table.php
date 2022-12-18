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
            $table->foreignId('jurnal_penesuaians_id');
            $table->foreignId('akuns_id');
            $table->integer('type')->default(1);
            $table->double('amount')->default(0);
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
