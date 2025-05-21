<?php

namespace App\Http\Controllers;

use App\Models\Coache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $coaches = Coache::all();
        return view('Admin.adm_pengurus', compact('coache'));
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
            'full_name.string' => 'Nama lengkap harus berupa teks.',
            'full_name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan pilih yang lain.',

            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',

            'image.string' => 'Gambar harus berupa path atau nama file yang valid.',
            'image.max'    => 'Nama file gambar maksimal 255 karakter.',
        ]);
    }

    $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
        }
        $request['foto_url'] = $newName;

        $pengurus = Coache::create($request->all());
        return redirect('admin/upload-pengurus')->withToastSuccess('Pengurus Berhasil Di Tambahkan!');
    

    public function edit($slug)
    {
        $coache = Coache::where('slug', $slug)->firstOrFail();

        return view('Admin.PengurusEdit', compact('coache'));
    }

    public function update(Request $request, $slug)
    {
        // Cari data pengurus berdasarkan slug lama
        $coache = Coache::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.string' => 'Nama lengkap harus berupa teks.',
            'full_name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan pilih yang lain.',

            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',

            'image.string' => 'Gambar harus berupa path atau nama file yang valid.',
            'image.max'    => 'Nama file gambar maksimal 255 karakter.',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->full_name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
            $coache->foto_url = $newName;
        }

        // Update data lain
        $coache->full_name = $request->sport_name;
        $coache->slug = $request->slug;
        $coache->save();

        return redirect('admin/upload-pengurus')->withToastSuccess('Pengurus Berhasil Diupdate!');
    }
    public function hapus($slug)
    {
        $coache = Coache::where('slug', $slug)->firstOrFail();

        // Hapus gambar dari storage jika ada
        if ($coache->foto_url && Storage::exists('foto/' . $coache->foto_url)) {
            Storage::delete('foto/' . $coache->foto_url);
        }

        // Hapus data dari database
        $coache->delete();

        return redirect()->route('pengurus.index')->withToastSuccess('Pengurus berhasil dihapus.');
    }
}