<?php

namespace App\Http\Controllers;

use App\Models\Coache;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
   public function index(Request $request)
{
    $query = Coache::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where('full_name', 'like', '%' . $search . '%')
              ->orWhere('jabatan', 'like', '%' . $search . '%');
    }

    // Tampilkan 10 data per halaman dan bawa parameter pencarian saat pagination
    $coaches = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());

    return view('Admin.adm_pengurus', compact('coaches'));
}


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $newName = null;
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = Str::slug($request->full_name) . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
        }

        // Simpan data
        Coache::create([
            'full_name' => $request->full_name,
            'jabatan' => $request->jabatan,
            'foto_url' => $newName,
            'slug' => Str::slug($request->full_name) . '-' . now()->timestamp,  // buat slug unik
        ]);

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $coache = Coache::where('slug', $slug)->firstOrFail();
        return view('Admin.PengurusEdit', compact('coache'));
    }

    public function update(Request $request, $slug)
    {
        $coache = Coache::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($coache->foto_url && Storage::exists('foto/' . $coache->foto_url)) {
                Storage::delete('foto/' . $coache->foto_url);
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = Str::slug($request->full_name) . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
            $coache->foto_url = $newName;
        }

        // Update data
        $coache->full_name = $request->full_name;
        $coache->jabatan = $request->jabatan;
        // Update slug juga jika nama berubah
        $coache->slug = Str::slug($request->full_name) . '-' . now()->timestamp;
        $coache->save();

        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil diupdate!');
    }

 public function hapus($slug)
{
    // Pakai model Coache karena itu yang digunakan di seluruh controller
    $pengurus = Coache::where('slug', $slug)->firstOrFail();

    // Hapus foto dari storage jika ada
    if ($pengurus->foto_url && Storage::exists('foto/' . $pengurus->foto_url)) {
        Storage::delete('foto/' . $pengurus->foto_url);
    }

    // Hapus data dari database
    $pengurus->delete();

    // Redirect dan kirim session flash message
    return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil dihapus!');
}
}
