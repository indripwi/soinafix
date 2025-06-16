@extends('layouts.Pengguna')

@section('content')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main class="main">

    <!-- Tombol Logout -->



    <!-- Page Title -->
    <div class="page-title bg-danger text-white py-5 shadow-sm" data-aos="fade">
        <div class="container text-center">
            <h1 class="fw-bold">Pendaftaran</h1>
            <p class="mt-2">Lengkapi formulir berikut untuk mendaftar sebagai atlet SOIna</p>
        </div>
        <nav class="breadcrumbs mt-3">
            <div class="container text-center">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white">Pendaftaran</li>
                </ol>
            </div>
        </nav>
    </div>
    @auth
    <div class="container mt-2 d-flex justify-content-end">
        <button id="logout-button" class="btn btn-outline-danger d-flex align-items-center gap-2 btn-sm">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    @endauth

    <div class="container my-5">
        <!-- Alerts -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan pada input Anda:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#d33'
            });
        </script>
        @endif


        <!-- Form -->
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label for="nama_pendaftar" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_pendaftar" value="{{ old('nama_pendaftar') }}" required>
            </div>

            <div class="col-md-6">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" value="{{ old('nik') }}" required>
            </div>

            <div class="col-md-6">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
            </div>

            <div class="col-md-6">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
            </div>

            <div class="col-md-6">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir"
    value="{{ old('tanggal_lahir', isset($item) ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('Y-m-d') : '') }}"
    required>

            </div>

            <div class="col-12">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="col-md-6">
                <label for="sekolah" class="form-label">Asal Sekolah</label>
                <input type="text" class="form-control" name="sekolah" value="{{ old('sekolah') }}" required>
            </div>

            <div class="col-md-6">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}" required>
            </div>

            <h5>Upload Dokumen</h5>

            @foreach([
            'file_akta' => 'Akta Kelahiran',
            'file_kk' => 'Kartu Keluarga',
            'file_foto' => 'Pas Foto',
            'file_raport' => 'Raport Terakhir',
            'file_psikolog' => 'Tes Psikologi'
            ] as $name => $label)
            <div class="col-md-6">
                <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                <input type="file" class="form-control" name="{{ $name }}" required>
            </div>
            @endforeach

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-danger px-5 py-2">Kirim Pendaftaran</button>
            </div>
        </form>

        
        <!-- Riwayat -->
        <hr class="mt-4">
        <div class="mt-5">
            <h3 class="text-center mb-3">Riwayat Pendaftaran</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-danger">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>No. Telepon</th>
                            <th>JK</th>
                            <th>Tempat</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>Akta</th>
                            <th>KK</th>
                            <th>Foto</th>
                            <th>Raport</th>
                            <th>Psikolog</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftarans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pendaftar }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->sekolah }}</td>
                            <td>{{ $item->kelas }}</td>

                            @foreach (['file_akta', 'file_kk', 'file_foto', 'file_raport', 'file_psikolog'] as $file)
                            <td>
                                @if ($item->$file)
                                <a href="{{ asset('storage/' . $item->$file) }}" class="btn btn-sm btn-outline-primary mb-1" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pendaftar.download', ['file' => $item->$file]) }}" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-download"></i>
                                </a>
                                @else
                                <em>-</em>
                                @endif
                            </td>
                            @endforeach

                            <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('pendaftaran.edit', ['slug' => $item->slug]) }}" class="btn btn-sm btn-success">Edit</a>
                                    <form class="form-hapus" data-nama="{{ $item->nama_pendaftar }}" action="{{ route('pendaftaran.hapus', ['slug' => $item->slug]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @auth
    <div class="container mt-2 d-flex justify-content-end">
        <button id="logout-button" class="btn btn-outline-danger d-flex align-items-center gap-2 btn-sm">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    @endauth
    </div>
    
</main>

<!-- Modal Login -->
@guest
<div class="modal fade" id="guestLoginModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Anda belum login</h5>
            </div>
            <div class="modal-body text-center">
                <p>Silakan login atau registrasi terlebih dahulu untuk melanjutkan pendaftaran.</p>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrasi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var guestModal = new bootstrap.Modal(document.getElementById('guestLoginModal'));
        guestModal.show();
    });
</script>
@endguest

<!-- Logout SweetAlert -->
<script>
    document.getElementById("logout-button")?.addEventListener("click", function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
<script>
    // Konfirmasi sebelum menghapus data
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Cegah submit langsung

            const nama = this.getAttribute('data-nama') || 'data ini';

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: Data atas nama "${nama}" akan dihapus secara permanen.,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit form jika dikonfirmasi
                }
            });
        });
    });
</script>

@endsection
