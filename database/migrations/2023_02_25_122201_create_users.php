<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_user', 8);
            $table->string('username', 20);
            $table->string('password', 80);
            $table->string('nama_depan', 20);
            $table->string('nama_belakang', 20);
            $table->tinyInteger('jenis_kelamin');
            $table->date('ttl');
            $table->tinyInteger('jabatan');
            $table->tinyInteger('status');
            $table->string('alamat_jalan', 100);
            $table->string('alamat_provinsi', 10);
            $table->string('alamat_kota_kabupaten', 10);
            $table->string('alamat_kecamatan', 10);
            $table->string('alamat_kelurahan', 10);
            $table->string('alamat_kode_pos', 5);
            $table->string('photo', 100)->nullable();
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
        Schema::dropIfExists('users');
    }
}
