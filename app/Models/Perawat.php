<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perawat extends Model
{
    protected $fillable = [
        'nama_perawat',
        'klinik_jaga',
        'status',
        'status_sip_perawat',
        'nomor_aktif_perawat',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
