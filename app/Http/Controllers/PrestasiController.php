<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $prestasis = Prestasi::when($search, function ($query, $search) {
            return $query->where('nama_atlet', 'like', "%{$search}%")
                ->orWhere('cabang_olahraga', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]); // supaya query tetap ada saat pindah halaman

        return view('Admin.adm_prestasi', compact('prestasis', 'search'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_atlet'       => 'required|string|max:255',
            'cabang_olahraga'  => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('image')) {
            $foto = uniqid('prestasi_') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('foto', $foto);
        }

        Prestasi::create([
            'nama_atlet'       => $validated['nama_atlet'],
            'slug'             => Str::slug($validated['nama_atlet']) . '-' . uniqid(),
            'cabang_olahraga'  => $validated['cabang_olahraga'],
            'deskripsi'        => $validated['deskripsi'] ?? null,
            'foto_url'         => $foto,
        ]);

        return redirect('admin/upload-prestasi')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();
        return view('Admin.PrestasiEdit', compact('prestasi'));
    }

    public function update(Request $request, $slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'nama_atlet'       => 'required|string|max:255',
            'cabang_olahraga'  => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($prestasi->foto_url && Storage::exists('foto/' . $prestasi->foto_url)) {
                Storage::delete('foto/' . $prestasi->foto_url);
            }

            $fotoBaru = uniqid('prestasi_') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('foto', $fotoBaru);
            $prestasi->foto_url = $fotoBaru;
        }

        $prestasi->nama_atlet = $validated['nama_atlet'];
        $prestasi->cabang_olahraga = $validated['cabang_olahraga'];
        $prestasi->deskripsi = $validated['deskripsi'] ?? null;
        $prestasi->slug = Str::slug($validated['nama_atlet']) . '-' . uniqid();
        $prestasi->save();

        return redirect('admin/upload-prestasi')->with('success', 'Prestasi berhasil diupdate!');
    }

    public function hapus($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        if ($prestasi->foto_url && Storage::exists('foto/' . $prestasi->foto_url)) {
            Storage::delete('foto/' . $prestasi->foto_url);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}
