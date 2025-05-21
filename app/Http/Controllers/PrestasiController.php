<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::all();
        return view('Admin.adm_prestasi', compact('prestasis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_atlet'       => 'required|string|max:255',
            'cabang_olahraga'  => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_atlet.required' => 'Nama Atlet wajib diisi.',
            'nama_atlet.string'   => 'Nama Atlet harus berupa teks.',
            'nama_atlet.max'      => 'Nama Atlet maksimal 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan pilih yang lain.',

            'cabang_olahraga.required' => 'Cabang olahraga wajib diisi.',
            'cabang_olahraga.string'   => 'Cabang olahraga harus berupa teks.',
            'cabang_olahraga.max'      => 'Cabang olahraga maksimal 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'image.string' => 'Gambar harus berupa path atau nama file yang valid.',
            'image.max'    => 'Nama file gambar maksimal 255 karakter.',
        ]);


        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
        }
        $request['foto_url'] = $newName;

        $perestasi = Prestasi::create($request->all());
        return redirect('admin/upload-prestasi')->withToastSuccess('Prestasi Berhasil Di Tambahkan!');
    }

    public function edit($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        return view('Admin.PrestasiEdit', compact('prestasi'));
    }

    public function update(Request $request, $slug)
    {
        // Cari data program berdasarkan slug lama
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'nama_atlet'       => 'required|string|max:255',
            'cabang_olahraga'  => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_atlet.required' => 'Nama Atlet wajib diisi.',
            'nama_atlet.string'   => 'Nama Atlet harus berupa teks.',
            'nama_atlet.max'      => 'Nama Atlet maksimal 255 karakter.',

            'cabang_olahraga.required' => 'Cabang Olahraga wajib diisi.',
            'cabang_olahraga.string'   => 'Cabang Olahraga harus berupa teks.',
            'cabang_olahraga.max'      => 'Cabang Olahraga maksimal 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Gambar harus berekstensi jpg, jpeg, atau png.',
            'image.max'    => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->sport_name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
            $prestasi->foto_url = $newName;
        }

        // Update data lain
        $prestasi->sport_name = $request->nama_atlet;
        $prestasi->slug = $request->slug;
        $prestasi->save();

        return redirect('admin/upload-prestasi')->withToastSuccess('Prestasi Berhasil Diupdate!');
    }
    public function hapus($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        // Hapus gambar dari storage jika ada
        if ($prestasi->foto_url && Storage::exists('foto/' . $prestasi->foto_url)) {
            Storage::delete('foto/' . $prestasi->foto_url);
        }

        // Hapus data dari database
        $prestasi->delete();

        return redirect()->route('prestasi.index')->withToastSuccess('Prestasi berhasil dihapus.');
    }
}
