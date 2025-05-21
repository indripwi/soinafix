@extends('layouts.Pengguna')

@section('content')
<main class="main">
    <div class="container py-5">
        <h1>Edit Pendaftaran</h1>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="Nama Lama">
            </div>

            <!-- NIK -->
            <div class="mb-4">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="1234567890123456">
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-4">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-4">
                <label for="ttl" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="ttl" name="ttl" value="2005-01-01">
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3">Alamat Lama</textarea>
            </div>

            <!-- Sekolah -->
            <div class="mb-4">
                <label for="sekolah" class="form-label">Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" value="SMA Negeri 1">
            </div>

            <!-- Kelas -->
            <div class="mb-4">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="XII IPA 1">
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="no_hp" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="081234567890">
            </div>

            <!-- Akta Kelahiran -->
            <div class="mb-4">
                <label for="akta" class="form-label">Akta Kelahiran</label>
                <input type="file" class="form-control" id="akta" name="akta">
            </div>

            <!-- Kartu Keluarga -->
            <div class="mb-4">
                <label for="kk" class="form-label">Kartu Keluarga</label>
                <input type="file" class="form-control" id="kk" name="kk">
            </div>

            <!-- Pas Foto -->
            <div class="mb-4">
                <label for="foto" class="form-label">Pas Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <!-- Rapor Terakhir -->
            <div class="mb-4">
                <label for="raport" class="form-label">Rapor Terakhir</label>
                <input type="file" class="form-control" id="raport" name="raport">
            </div>

            <!-- Tes Psikologi -->
            <div class="mb-4">
                <label for="psikotes" class="form-label">Tes Psikologi</label>
                <input type="file" class="form-control" id="psikotes" name="psikotes">
            </div>

            <!-- Button Submit -->
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-danger">Update Pendaftaran</button>
            </div>
        </form>
    </div>
</main>
@endsection
