<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'no_barang',
        'name_barang',
        'stok',
        'harga_beli',
        'harga_jual',
    ];

    public function getRouteKeyName()
    {
        return 'no_barang';
    }
}