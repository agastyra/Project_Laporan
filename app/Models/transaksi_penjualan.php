<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaction',
        'date',
        'customer',
        'grand_total',
        'diskon',
        'bayar',
        'kembali',
    ];

    public function detail_penjualan()
    {
        return $this->hasMany(detail_penjualan::class);
    }
}
