<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'perawat',
            'role' => 'perawat',
            'email' => 'perawat@perawat.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory()->create([
            'name' => 'dokter',
            'role' => 'dokter',
            'email' => 'dokter@dokter.com',
            'password' => Hash::make('admin'),

        ]);
        User::factory()->create([
            'name' => 'karyawan',
            'role' => 'karyawan',
            'email' => 'karyawan@karyawan.com',
            'password' => Hash::make('admin'),

        ]);
        User::factory()->create([
            'name' => 'kandidat',
            'role' => 'kandidat',
            'email' => 'kandidat@kandidat.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
