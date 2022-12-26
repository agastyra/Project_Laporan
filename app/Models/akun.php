<?php

namespace App\Models;

use App\Models\jurnal_memorial_detail;
use App\Models\jurnal_penyesuaian_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'no_account';
    }

    public function jurnal_penyesuaian_detail()
    {
        return $this->hasMany(jurnal_penyesuaian_detail::class);
    }

    public function jurnal_memorial_detail()
    {
        return $this->hasMany(jurnal_memorial_detail::class);
    }
}
