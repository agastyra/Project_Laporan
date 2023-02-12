<?php

namespace App\Models;

use App\Models\detail_pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'no_transaction';
    }

    /**
     * Get the bukti_kas_keluar associated with the transaksi_pembelian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bukti_kas_keluar()
    {
        return $this->hasOne(bukti_kas_keluar::class);
    }

    /**
     * Get all of the detail_pembelian for the transaksi_pembelian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_pembelian()
    {
        return $this->hasMany(detail_pembelian::class);
    }
}
