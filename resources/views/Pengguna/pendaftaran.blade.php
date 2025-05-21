@extends('layouts.Pengguna')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pendaftaran</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="current">Pendaftaran</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->
    <section class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pendaftaran') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>

                <div class="col-12 mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sekolah" class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control" id="sekolah" name="sekolah" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" required>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Upload Dokumen</h5>

                <div class="col-md-6 mb-3">
                    <label for="akta_kelahiran" class="form-label">Akta Kelahiran</label>
                    <input class="form-control" type="file" id="akta_kelahiran" name="akta_kelahiran" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kartu_keluarga" class="form-label">Kartu Keluarga</label>
                    <input class="form-control" type="file" id="kartu_keluarga" name="kartu_keluarga" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pas_foto" class="form-label">Pas Foto</label>
                    <input class="form-control" type="file" id="pas_foto" name="pas_foto" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="raport_terakhir" class="form-label">Raport Terakhir</label>
                    <input class="form-control" type="file" id="raport_terakhir" name="raport_terakhir" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tes_psikologi" class="form-label">Tes Psikologi</label>
                    <input class="form-control" type="file" id="tes_psikologi" name="tes_psikologi" required>
                </div>

                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-danger px-5 py-2">Kirim Pendaftaran</button>
                </div>
            </form>
        </div>
    </section>
</main>

@endsection

