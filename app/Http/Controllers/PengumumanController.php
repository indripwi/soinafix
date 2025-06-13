<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('Admin.adm_pengumuman', compact('announcements'));
    }

   public function store(Request $request)
{
    if (
        !$request->filled('title') &&
        !$request->hasFile('image') &&
        !$request->hasFile('pdf_file')
    ) {
        return back()->withErrors(['Harap isi minimal satu dari: Judul, Gambar, atau File PDF.'])->withInput();
    }

    $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    $pengumuman = new Announcement();

    if ($request->filled('title')) {
        $pengumuman->title = $request->title;
    }

    if ($request->hasFile('image')) {
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = 'img-' . now()->timestamp . '.' . $extension;
        $request->file('image')->storeAs('public/foto', $imageName);
        $pengumuman->gambar_url = $imageName;
    }

    if ($request->hasFile('pdf_file')) {
        $pdfName = 'pdf-' . time() . '_' . $request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('public/announcements', $pdfName);
        $pengumuman->pdf_file = $pdfName;
    }

    $pengumuman->slug = Str::slug($pengumuman->title . '-' . time());
    $pengumuman->save();

    // ⬇ Ini yang akan dikirim ke blade untuk trigger SweetAlert
    return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
}


   public function edit($slug)
{
    $announcement = Announcement::where('slug', $slug)->firstOrFail();
    return view('Admin.PengumumanEdit', compact('announcement'));
}


    public function update(Request $request, $slug)
    {
        $announcement = Announcement::where('slug', $slug)->firstOrFail();

        if (
            !$request->filled('title') &&
            !$request->hasFile('image') &&
            !$request->hasFile('pdf_file')
        ) {
            return back()->withErrors(['Harap isi minimal satu dari: Judul, Gambar, atau File PDF.'])->withInput();
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->filled('title')) {
            $announcement->title = $request->title;
        }

        if ($request->hasFile('image')) {
            if ($announcement->gambar_url && Storage::exists('public/foto/' . $announcement->gambar_url)) {
                Storage::delete('public/foto/' . $announcement->gambar_url);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = 'img-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('public/foto', $imageName);
            $announcement->gambar_url = $imageName;
        }

        if ($request->hasFile('pdf_file')) {
            if ($announcement->pdf_file && Storage::exists('public/announcements/' . $announcement->pdf_file)) {
                Storage::delete('public/announcements/' . $announcement->pdf_file);
            }

            $pdfName = 'pdf-' . time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('public/announcements', $pdfName);
            $announcement->pdf_file = $pdfName;
        }

        $announcement->save();

        return redirect()->route('pengumuman.index')->withToastSuccess('Pengumuman Berhasil Diupdate!');
    }

    public function download($id)
    {
        $announcement = Announcement::findOrFail($id);
        $filePath = 'announcements/' . $announcement->pdf_file;

        if (!$announcement->pdf_file || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function destroy($slug)
    {
        $announcement = Announcement::where('slug', $slug)->firstOrFail();

        if ($announcement->gambar_url && Storage::exists('public/foto/' . $announcement->gambar_url)) {
            Storage::delete('public/foto/' . $announcement->gambar_url);
        }

        if ($announcement->pdf_file && Storage::exists('public/announcements/' . $announcement->pdf_file)) {
            Storage::delete('public/announcements/' . $announcement->pdf_file);
        }

        $announcement->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
