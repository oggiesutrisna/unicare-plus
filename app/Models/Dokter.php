<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticable;

class Dokter extends Authenticable implements FilamentUser
{
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'dokter') {
            return str_ends_with($this->email, '@dokter.com') && $this->hasVerifiedEmail();
        }

        return true;
    }

    protected $fillable = [
        'user_id',
        'nama_dokter',
        'status_sip_dokter',
        'klinik_jaga',
        'status',
        'spesialis',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
