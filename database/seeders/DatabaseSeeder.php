<?php

namespace Database\Seeders;

use App\Models\akun;
use App\Models\barang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        akun::create([
            'no_account' => '1000',
            'name_account' => 'Aktiva Lancar',
            'is_header_account' => true,
            'type_account' => "1",
        ]);

        akun::create([
            'no_account' => '1001',
            'name_account' => 'Kas',
            'header_account' => "1000",
            'type_account' => "1",
        ]);

        barang::create([
            'no_barang' => 'BRG01',
            'name_barang' => 'Tas Guci',
            'stok' => 4,
            'harga_beli' => 300000,
            'harga_jual' => 400000,
        ]);

        barang::create([
            'no_barang' => 'BRG02',
            'name_barang' => 'baju bape',
            'stok' => 3,
            'harga_beli' => 400000,
            'harga_jual' => 700000,
        ]);
    }
}