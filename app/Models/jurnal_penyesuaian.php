<?php

namespace App\Models;

use App\Models\jurnal_penyesuaian_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_penyesuaian extends Model
{
    use HasFactory;

    // protected $table = "jurnal_penyesuaian";
    // protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'date',
        'debet',
        'kredit',
    ];

    // protected $guarded = [
    //     'id',
    // ];

    public function jurnal_penyesuaian_detail()
    {
        return $this->hasMany(jurnal_penyesuaian_detail::class);
    }
}