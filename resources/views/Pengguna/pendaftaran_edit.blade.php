@extends('layouts.Pengguna')

@section('content')
<main class="main">
    <div class="container py-5">
        <h2 class="mb-4 text-center">Edit Data Pendaftaran</h2>

        <form action="{{ route('pendaftaran.update', $pendaftaran->slug) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6 mb-3">
                <label for="nama_pendaftar" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar" value="{{ $pendaftaran->nama_pendaftar }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="{{ $pendaftaran->nik }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $pendaftaran->nomor_telepon }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $pendaftaran->tempat_lahir }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
       value="{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('Y-m-d') }}" required>

            </div>

            <div class="col-md-12 mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pendaftaran->alamat }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="sekolah" class="form-label">Asal Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ $pendaftaran->sekolah }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $pendaftaran->kelas }}" required>
            </div>

            @foreach ([
                'file_akta' => 'Akta Kelahiran',
                'file_kk' => 'Kartu Keluarga',
                'file_foto' => 'Pas Foto',
                'file_raport' => 'Raport Terakhir',
                'file_psikolog' => 'Tes Psikologi',
            ] as $data => $label)
                <div class="col-md-6 mb-3">
                    <label for="{{ $data }}" class="form-label">{{ $label }}</label>
                    <input class="form-control" type="file" id="{{ $data }}" name="{{ $data }}">

                    @if ($pendaftaran->$data)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $pendaftaran->$data) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-eye"></i> Lihat File Lama
                            </a>
                            <a href="{{ route('pendaftar.download', ['file' => $pendaftaran->$data]) }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="col-12 text-center mt-4 d-flex justify-content-center gap-3">
                <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-secondary px-4 py-2">Batal</a>
                <button type="submit" class="btn btn-primary px-4 py-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>
@endsection
