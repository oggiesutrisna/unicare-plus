<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karyawan extends Model
{
    protected $fillable = [
        'nama_karyawan',
        'nomor_aktif_karyawan',
        'status',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
