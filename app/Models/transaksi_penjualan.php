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
        'grand_total',
        'bayar',
        'kembali',
    ];

    protected $hidden = [];

    public function bukti_kas_masuk(){
        return $this->hasMany(bukti_kas_masuk::class);
    }
}
