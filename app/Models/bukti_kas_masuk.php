<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukti_kas_masuk extends Model
{
    use HasFactory;

    protected $fillable=[
        'no_bkm',
        'tanggal',
        'transaksi_penjualan_id',
        'jurnal_memorial_id',
        'description',
        'total'
    ];

    protected $hidden = [];

    public function transaksi_penjualan(){
        return $this->belongsTo(transaksi_penjualan::class);
    }

    public function jurnal_memorial()
    {
        return $this->belongsTo(jurnal_memorial::class);
    }
}
