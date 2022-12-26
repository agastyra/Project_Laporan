<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_penjualans_id',
        'barangs_id',
        'qty',
        'subTotal',
    ];

    public function transaksi_penjualan()
    {
        return $this->belongsTo(transaksi_penjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
}
