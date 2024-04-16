<?php

namespace App\Http\Controllers;

use App\Models\Hiring;
use Illuminate\Http\Request;

class HiringController extends Controller
{
    public function index()
    {
        return Hiring::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kandidat' => ['required'],
            'nomor_hp_aktif_kandidat' => ['required'],
            'lulusan_kandidat' => ['required'],
            'alamat_kandidat' => ['required'],
        ]);

        return Hiring::create($data);
    }

    public function show(Hiring $hiring)
    {
        return $hiring;
    }

    public function update(Request $request, Hiring $hiring)
    {
        $data = $request->validate([
            'nama_kandidat' => ['required'],
            'nomor_hp_aktif_kandidat' => ['required'],
            'lulusan_kandidat' => ['required'],
            'alamat_kandidat' => ['required'],
        ]);

        $hiring->update($data);

        return $hiring;
    }

    public function destroy(Hiring $hiring)
    {
        $hiring->delete();

        return response()->json();
    }
}
