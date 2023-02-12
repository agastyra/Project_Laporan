<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukti_kas_keluar extends Model
{
    use HasFactory;

    /**
     * Get the transaksi_pembelian that owns the bukti_kas_keluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaksi_pembelian()
    {
        return $this->belongsTo(transaksi_pembelian::class);
    }
}
