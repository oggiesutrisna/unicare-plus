<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perawats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perawat');
            $table->string('klinik_jaga');
            $table->string('status');
            $table->string('status_sip_perawat');
            $table->string('nomor_aktif_perawat');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perawats');
    }
};
