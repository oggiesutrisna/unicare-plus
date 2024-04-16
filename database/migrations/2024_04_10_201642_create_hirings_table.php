<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hirings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained('users');
            $table->string('nama_kandidat');
            $table->string('nomor_hp_aktif_kandidat');
            $table->string('lulusan_kandidat');
            $table->text('alamat_kandidat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hirings');
    }
};
