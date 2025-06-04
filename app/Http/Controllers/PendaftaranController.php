<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('Pengguna.pendaftaran', compact('pendaftarans'));
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
            'file_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'file_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'file_foto' => 'required|file|mimes:jpg,jpeg,png|max:4096',
            'file_raport' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'file_psikolog' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',

        ]);

        $data = $request->except(['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog']);
        $data['slug'] = Str::slug($request->nama_pendaftar . '-' . now()->timestamp);

        $data['file_akta'] = $request->file('file_akta')->store('berkas', 'public');
        $data['file_kk'] = $request->file('file_kk')->store('berkas', 'public');
        $data['file_foto'] = $request->file('file_foto')->store('berkas', 'public');
        $data['file_raport'] = $request->file('file_raport')->store('berkas', 'public');
        $data['file_psikolog'] = $request->file('file_psikolog')->store('berkas', 'public');


        Pendaftaran::create($data);

        return redirect('pengguna/pendaftaran')->withToastSuccess('Pendaftaran berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $pendaftaran = Pendaftaran::where('slug', $slug)->firstOrFail();
        return view('Pengguna.pendaftaran_edit', compact('pendaftaran'));
    }

    public function update(Request $request, $slug)
    {
        $pendaftaran = Pendaftaran::where('slug', $slug)->firstOrFail();

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

        // ✅ Tambahkan ini
        $data = $request->except(['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog']);

        foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $fileField) {
            if ($request->hasFile($fileField)) {
                if ($pendaftaran->$fileField && Storage::exists($pendaftaran->$fileField)) {
                    Storage::delete($pendaftaran->$fileField);
                }
                $data[$fileField] = $request->file($fileField)->store('berkas', 'public');
            }
        }

        $pendaftaran->update($data);

        return redirect('pengguna/pendaftaran')->withToastSuccess('Pendaftaran berhasil diperbarui!');
    }

    public function hapus($slug)
    {
        $pendaftaran = Pendaftaran::where('slug', $slug)->firstOrFail();

        foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $fileField) {
            if ($pendaftaran->$fileField && Storage::exists($pendaftaran->$fileField)) {
                Storage::delete($pendaftaran->$fileField);
            }
        }

        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->withToastSuccess('Pendaftaran berhasil dihapus.');
    }

        public function download(Request $request)
    {
        $file = $request->query('file');

        if (!$file || !Storage::disk('public')->exists($file)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($file);
    }

}
