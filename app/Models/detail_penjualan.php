<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'no_transaction';
    }

    protected $fillable = [
        'no_transaction',
        'barang_id',
        'qty',
        'subTotal',
    ];

    protected $hidden = [];

    // public function transaksi_penjualan()
    // {
    //     return $this->belongsTo(transaksi_penjualan::class);
    // }

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }

    public function transaksi_penjualan()
    {
        return $this->belongsTo(transaksi_penjualan::class);
    }
}
