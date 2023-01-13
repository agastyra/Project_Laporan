<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaction',
        'barangs_id',
        'harga_jual',
        'qty',
        'subTotal',
    ];

    // public function transaksi_penjualan()
    // {
    //     return $this->belongsTo(transaksi_penjualan::class);
    // }

    public function barang()
    {
        return $this->belongsTo(barang::class, 'barangs_id', 'id');
    }

    // public function transaksi_penjualan()
    // {
    //     return $this->belongsTo(transaksi_penjualan::class, 'no_transaction', 'no_transaction');
    // }
}
