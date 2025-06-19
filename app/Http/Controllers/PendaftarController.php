<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;


class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::query();

        // Fitur pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pendaftar', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%')
                    ->orWhere('nomor_telepon', 'like', '%' . $request->search . '%');
            });
        }

        // Fitur filter tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $pendaftars = $query->latest()->get();

        // Daftar tahun unik dari data
        $tahunList = Pendaftaran::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Ganti ke view admin, bukan pengguna
        return view('Admin.adm_pendaftar', compact('pendaftars', 'tahunList'));
    }
    public function export()
    {
        $pendaftars = Pendaftaran::all();
        $pdf = Pdf::loadView('Admin.export_pendaftar_pdf', compact('pendaftars'));
        return $pdf->download('data_pendaftar.pdf');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pendaftar' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'nomor_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'sekolah' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'file_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'file_raport' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_psikolog' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog']);
        $data['slug'] = Str::slug($request->nama_pendaftar . '-' . now()->timestamp);

        $data['file_akta'] = $request->file('file_akta')->store('berkas', 'public');
        $data['file_kk'] = $request->file('file_kk')->store('berkas', 'public');
        $data['file_foto'] = $request->file('file_foto')->store('berkas', 'public');
        $data['file_raport'] = $request->file('file_raport')->store('berkas', 'public');
        $data['file_psikolog'] = $request->file('file_psikolog')->store('berkas', 'public');

        Pendaftaran::create($data);

        return redirect('admin/pendaftar')->withToastSuccess('Pendaftar berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $pendaftar = Pendaftaran::where('slug', $slug)->firstOrFail();
        return view('Admin.pendaftarEdit', compact('pendaftar'));
    }

    public function update(Request $request, $slug)
    {
        $pendaftar = Pendaftaran::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'nama_pendaftar' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'nomor_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'sekolah' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'file_akta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_psikolog' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);


        foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $fileField) {
            if ($request->hasFile($fileField)) {
                if ($pendaftar->$fileField && Storage::exists($pendaftar->$fileField)) {
                    Storage::delete($pendaftar->$fileField);
                }
                $data[$fileField] = $request->file($fileField)->store('berkas', 'public');
            }
        }

        $pendaftar->update($data);

        return redirect('admin/pendaftar')->withToastSuccess('Pendaftar berhasil diperbarui!');
    }

    public function hapus($slug)
    {
        $pendaftar = Pendaftaran::where('slug', $slug)->firstOrFail();

        foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $fileField) {
            if ($pendaftar->$fileField && Storage::exists($pendaftar->$fileField)) {
                Storage::delete($pendaftar->$fileField);
            }
        }

        $pendaftar->delete();

        return redirect()->route('pendaftar.index')->withToastSuccess('Pendaftaran berhasil dihapus.');
    }

    public function download(Request $request)
    {
        $file = $request->query('file');

        if (!$file || !Storage::disk('public')->exists($file)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($file);
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:menunggu,lolos,tidak lolos',
        ]);

        $pendaftar = Pendaftaran::findOrFail($id);
        $pendaftar->status_verifikasi = $request->input('status_verifikasi');
        $pendaftar->save();

        // Debug
        Log::info('Status updated: ' . $pendaftar->status_verifikasi);

        return redirect()->route('pendaftar.index')->withToastSuccess('Status verifikasi berhasil diperbarui.');
    }

    public function arsipLolos()
    {
        $pendaftarans = Pendaftaran::where('status_verifikasi', 'lolos')->get();
        return view('admin.arsip-lolos', compact('pendaftarans'));
    }

    public function show($slug)
    {
        $pendaftaran = Pendaftaran::where('slug', $slug)->firstOrFail();
        return view('admin.pendaftar-detail', compact('pendaftaran'));
    }

    public function exportLolosPdf()
    {
        $pendaftarans = Pendaftaran::where('status_verifikasi', 'lolos')->get();

        $pdf = Pdf::loadView('admin.pendaftar-lolos-pdf', compact('pendaftarans'));

        return $pdf->download('arsip-pendaftar-lolos.pdf');
    }
}
