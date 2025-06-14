@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Prestasi Atlet</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Prestasi</a>
                </li>
            </ul>
        </div>

        {{-- Error Handling --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada kesalahan pada input Anda:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Prestasi</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputModal">
                    <i class="fas fa-plus-circle me-1"></i> Input Prestasi
                </button>
            </div>

            <div class="card-body">
                <form action="{{ route('prestasi.index') }}" method="GET" class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atlet..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-sync-alt me-1"></i> Reset
                        </a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-success text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Atlet</th>
                                <th>Cabang Olahraga</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prestasis as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_atlet }}</td>
                                    <td>{{ $item->cabang_olahraga }}</td>
                                    <td class="text-center">
                                        <img src="{{ $item->foto_url ? asset('storage/foto/' . $item->foto_url) : asset('img/foto-tidak-ada.png') }}"
                                            alt="Foto Atlet" class="img-thumbnail" style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $item->deskripsi }}</td>
                                  <td class="text-center">
    <div class="d-flex justify-content-center gap-2 flex-wrap">
        <a href="{{ route('prestasi.edit', $item->slug) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('prestasi.hapus', $item->slug) }}" method="POST" class="form-delete">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm btn-delete">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </form>
    </div>
</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data prestasi yang diinput.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $prestasis->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Input Prestasi -->
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLabel">Input Data Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_atlet" class="form-label">Nama Atlet</label>
                        <input type="text" name="nama_atlet" id="nama_atlet" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cabang_olahraga" class="form-label">Cabang Olahraga</label>
                        <input type="text" name="cabang_olahraga" id="cabang_olahraga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_url" class="form-label">Gambar</label>
                        <input type="file" name="image" id="foto_url" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Load SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script konfirmasi hapus & notifikasi --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endsection
