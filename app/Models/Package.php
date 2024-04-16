<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    protected $fillable = [
        'judul_package',
        'slug',
        'gambar',
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
