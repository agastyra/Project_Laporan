<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the detail_pembelian for the barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_pembelian()
    {
        return $this->hasMany(detail_pembelian::class);
    }
}
