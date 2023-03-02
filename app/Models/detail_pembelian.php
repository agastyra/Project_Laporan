<?php

namespace App\Models;

use App\Models\transaksi_pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the transaksi_pembelian that owns the detail_pembelian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaksi_pembelian()
    {
        return $this->belongsTo(transaksi_pembelian::class);
    }

    /**
     * Get the barang that owns the detail_pembelian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
}
