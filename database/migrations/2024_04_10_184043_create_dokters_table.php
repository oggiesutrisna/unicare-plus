<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained('users');
            $table->string('nama_dokter');
            $table->string('status_sip_dokter');
            $table->string('klinik_jaga');
            $table->string('status');
            $table->string('nomor_telepon_aktif');
            $table->string('spesialis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
