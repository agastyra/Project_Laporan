<?php

namespace App\Models;

use App\Models\jurnal_memorial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_memorial_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurnal_memorials_id',
        'akuns_id',
        'type',
        'amount',
    ];

    public function jurnal_memorial()
    {
        return $this->belongsTo(jurnal_memorial::class);
    }
}
