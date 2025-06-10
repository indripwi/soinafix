<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
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
    // Validasi: semua field opsional
    $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    $pengumuman = new Announcement();

    // Simpan judul jika ada
    if ($request->filled('title')) {
        $pengumuman->title = $request->title;
    }

    // Simpan gambar jika ada
    if ($request->hasFile('image')) {
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = 'img-' . now()->timestamp . '.' . $extension;
        $request->file('image')->storeAs('foto', $imageName);
        $pengumuman->gambar_url = $imageName;
    }

    // Simpan PDF jika ada
    if ($request->hasFile('pdf_file')) {
        $pdfName = 'pdf-' . time() . '_' . $request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('public/announcements', $pdfName);
        $pengumuman->pdf_file = $pdfName;
    }

    $pengumuman->save();

    return redirect('admin/upload-pengumuman')->withToastSuccess('Pengumuman Berhasil Ditambahkan!');
}

public function update(Request $request, $slug)
{
    $announcement = Announcement::where('slug', $slug)->firstOrFail();

    // Validasi: semua field opsional
    $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    // Update title jika diisi
    if ($request->filled('title')) {
        $announcement->title = $request->title;
    }

    // Ganti gambar jika ada file baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($announcement->gambar_url && Storage::exists('public/foto/' . $announcement->gambar_url)) {
            Storage::delete('public/foto/' . $announcement->gambar_url);
        }

        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = 'img-' . now()->timestamp . '.' . $extension;
        $request->file('image')->storeAs('public/foto', $imageName);
        $announcement->gambar_url = $imageName;
    }

    // Ganti PDF jika ada file baru
    if ($request->hasFile('pdf_file')) {
        // Hapus PDF lama jika ada
        if ($announcement->pdf_file && Storage::exists('public/announcements/' . $announcement->pdf_file)) {
            Storage::delete('public/announcements/' . $announcement->pdf_file);
        }

        $pdfName = 'pdf-' . time() . '_' . $request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('public/announcements', $pdfName);
        $announcement->pdf_file = $pdfName;
    }

    $announcement->save();

    return redirect('admin/upload-pengumuman')->withToastSuccess('Pengumuman Berhasil Diupdate!');
}

public function download(Request $request)
    {
        $pdfName = $request->query('file');

        if (!$pdfName || !Storage::disk('public')->exists($pdfName)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($pdfName);
        
    }


public function destroy($slug)
{
    $announcement = Announcement::where('slug', $slug)->firstOrFail();

    // Hapus gambar jika ada
    if ($announcement->gambar_url && Storage::exists('public/foto/' . $announcement->gambar_url)) {
        Storage::delete('public/foto/' . $announcement->gambar_url);
    }

    // Hapus PDF jika ada
    if ($announcement->pdf_file && Storage::exists('public/announcements/' . $announcement->pdf_file)) {
        Storage::delete('public/announcements/' . $announcement->pdf_file);
    }

    $announcement->delete();

    return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
}

}

