<?php

namespace Database\Seeders;

use App\Models\akun;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\jurnal_memorial;
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
            'name_barang' => 'Tas Lampu',
            'stok' => 10,
            'harga_beli' => 1000000,
            'harga_jual' => 50000,
        ]);

        barang::create([
            'no_barang' => 'BRG03',
            'name_barang' => 'Sepatu Nike',
            'stok' => 50,
            'harga_beli' => 10000,
            'harga_jual' => 50000,
        ]);

        barang::create([
            'no_barang' => 'BRG04',
            'name_barang' => 'Sepatu Adidas',
            'stok' => 50,
            'harga_beli' => 15000,
            'harga_jual' => 55000,
        ]);

        barang::create([
            'no_barang' => 'BRG05',
            'name_barang' => 'kucing',
            'stok' => 4,
            'harga_beli' => 300000,
            'harga_jual' => 400000,
        ]);

        //jurnal_memorial::create([
          //  'date' => date('ymd'),
          //'transaction_no' => "MEMO01",
          //  'debet' => 300000,
          //  'kredit' => 0
        //]);
    

    }
}
