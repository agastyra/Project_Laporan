<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_trans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hasMany(barang::class);
    }

    public function transaksi_penjualan()
    {
        return $this->hasMany(transaksi_penjualan::class);
    }
}
