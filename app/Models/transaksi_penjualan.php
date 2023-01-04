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
        'customer_id',
        'sub_total',
        'grand_total',
        'diskon',
        'bayar',
        'kembali',
        'valid'
    ];

    protected $hidden = [];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    // public function detail_penjualan()
    // {
    //     return $this->hasMany(detail_penjualan::class);
    // }
}
