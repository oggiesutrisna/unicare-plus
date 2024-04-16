<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hiring extends Model
{
    protected $fillable = [
        'nama_kandidat',
        'nomor_hp_aktif_kandidat',
        'lulusan_kandidat',
        'alamat_kandidat',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
