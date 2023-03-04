<?php

namespace App\Models;

use App\Models\akun;
use App\Models\jurnal_penyesuaian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_penyesuaian_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jurnal_penyesuaian()
    {
        return $this->belongsTo(jurnal_penyesuaian::class);
    }

    /**
     * Get the akun that owns the jurnal_penyesuaian_detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function akun()
    {
        return $this->belongsTo(akun::class);
    }
}