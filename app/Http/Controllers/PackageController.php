<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return Package::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_package' => ['required'],
            'slug' => ['required'],
            'gambar' => ['required'],
        ]);

        return Package::create($data);
    }

    public function show(Package $package)
    {
        return $package;
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'judul_package' => ['required'],
            'slug' => ['required'],
            'gambar' => ['required'],
        ]);

        $package->update($data);

        return $package;
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json();
    }
}
