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

            <!-- Tambahkan input lain sesuai field yang ada -->

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>
@endsection
