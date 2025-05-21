<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OlahragaController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('Admin.adm_program', compact('programs'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'sport_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'sport_name.required' => 'Nama cabang olahraga wajib diisi.',
            'sport_name.string'   => 'Nama cabang olahraga harus berupa teks.',
            'sport_name.max'      => 'Nama cabang olahraga maksimal 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan pilih yang lain.',

            'image.string' => 'Gambar harus berupa path atau nama file yang valid.',
            'image.max'    => 'Nama file gambar maksimal 255 karakter.',
        ]);


        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
        }
        $request['gambar_url'] = $newName;

        $perogram = Program::create($request->all());
        return redirect('admin/upload-program')->withToastSuccess('Program Berhasil Di Tambahkan!');
    }

    public function edit($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();

        return view('Admin.ProgramEdit', compact('program'));
    }

    public function update(Request $request, $slug)
    {
        // Cari data program berdasarkan slug lama
        $program = Program::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'sport_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'sport_name.required' => 'Nama cabang olahraga wajib diisi.',
            'sport_name.string'   => 'Nama cabang olahraga harus berupa teks.',
            'sport_name.max'      => 'Nama cabang olahraga maksimal 255 karakter.',

            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Gambar harus berekstensi jpg, jpeg, atau png.',
            'image.max'    => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->sport_name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
            $program->gambar_url = $newName;
        }

        // Update data lain
        $program->sport_name = $request->sport_name;
        $program->slug = $request->slug;
        $program->save();

        return redirect('admin/upload-program')->withToastSuccess('Program Berhasil Diupdate!');
    }
    public function hapus($slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();

        // Hapus gambar dari storage jika ada
        if ($program->gambar_url && Storage::exists('foto/' . $program->gambar_url)) {
            Storage::delete('foto/' . $program->gambar_url);
        }

        // Hapus data dari database
        $program->delete();

        return redirect()->route('olahraga.index')->withToastSuccess('Program berhasil dihapus.');
    }
}
