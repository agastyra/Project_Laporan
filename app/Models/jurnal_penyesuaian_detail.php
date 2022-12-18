<?php

namespace App\Models;

use App\Models\jurnal_penyesuaian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_penyesuaian_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurnal_penesuaians_id',
        'akuns_id',
        'type',
        'amount',
    ];

    public function jurnal_penyesuaian()
    {
        return $this->belongsTo(jurnal_penyesuaian::class);
    }
}
