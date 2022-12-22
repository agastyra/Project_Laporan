<?php

namespace Database\Seeders;

use App\Models\akun;
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
        ]);

        akun::create([
            'no_account' => '1001',
            'name_account' => 'Kas',
            'header_account' => "1000",
        ]);
    }
}
