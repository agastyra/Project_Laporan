<?php

namespace App\Models;

use App\Models\akun;
use App\Models\jurnal_memorial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_memorial_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jurnal_memorial()
    {
        return $this->belongsTo(jurnal_memorial::class);
    }

    /**
     * Get the akun that owns the jurnal_memorial_detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function akun()
    {
        return $this->belongsTo(akun::class);
    }
}
