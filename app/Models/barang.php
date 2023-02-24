<?php

namespace App\Models;

use App\Models\detail_pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'no_barang';
    }

    /**
     * Get all of the detail_pembelian for the barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function detail_pembelian()
    {
        return $this->hasMany(detail_pembelian::class);
    }

    public function detail_penjualan()
    {
        return $this->hasMany(detail_penjualan::class);
    }
}
