<?php

namespace App\Models;

use App\Models\jurnal_memorial_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal_memorial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jurnal_memorial_detail()
    {
        return $this->hasMany(jurnal_memorial_detail::class);
    }
}
