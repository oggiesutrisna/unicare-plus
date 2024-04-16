<?php

namespace App\Http\Controllers;

use App\Models\Perawat;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        return Perawat::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_perawat' => ['required'],
            'klinik_jaga' => ['required'],
            'status' => ['required'],
            'status_sip_perawat' => ['required'],
            'nomor_aktif_perawat' => ['required'],
        ]);

        return Perawat::create($data);
    }

    public function show(Perawat $perawat)
    {
        return $perawat;
    }

    public function update(Request $request, Perawat $perawat)
    {
        $data = $request->validate([
            'nama_perawat' => ['required'],
            'klinik_jaga' => ['required'],
            'status' => ['required'],
            'status_sip_perawat' => ['required'],
            'nomor_aktif_perawat' => ['required'],
        ]);

        $perawat->update($data);

        return $perawat;
    }

    public function destroy(Perawat $perawat)
    {
        $perawat->delete();

        return response()->json();
    }
}
