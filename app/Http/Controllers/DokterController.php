<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return Dokter::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_dokter' => ['required'],
            'status_sip_dokter' => ['required'],
            'klinik_jaga' => ['required'],
            'status' => ['required'],
            'spesialis' => ['required'],
        ]);

        return Dokter::create($data);
    }

    public function show(Dokter $dokter)
    {
        return $dokter;
    }

    public function update(Request $request, Dokter $dokter)
    {
        $data = $request->validate([
            'nama_dokter' => ['required'],
            'status_sip_dokter' => ['required'],
            'klinik_jaga' => ['required'],
            'status' => ['required'],
            'spesialis' => ['required'],
        ]);

        $dokter->update($data);

        return $dokter;
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return response()->json();
    }
}
