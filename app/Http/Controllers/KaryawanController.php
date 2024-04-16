<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        return Karyawan::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_karyawan' => ['required'],
            'nomor_aktif_karyawan' => ['required'],
            'status' => ['required'],
        ]);

        return Karyawan::create($data);
    }

    public function show(Karyawan $karyawan)
    {
        return $karyawan;
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $data = $request->validate([
            'nama_karyawan' => ['required'],
            'nomor_aktif_karyawan' => ['required'],
            'status' => ['required'],
        ]);

        $karyawan->update($data);

        return $karyawan;
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return response()->json();
    }
}
