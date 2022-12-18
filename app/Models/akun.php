<?php

namespace App\Models;

use App\Models\jurnal_memorial_detail;
use App\Models\jurnal_penyesuaian_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_account',
        'name_account',
        'is_header_account',
        'header_account',
        'balance',
    ];

    public function jurnal_penyesuaian_detail()
    {
        return $this->hasMany(jurnal_penyesuaian_detail::class);
    }

    public function jurnal_memorial_detail()
    {
        return $this->hasMany(jurnal_memorial_detail::class);
    }
}
